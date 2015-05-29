<?php namespace Kileo\Http\Controllers\Pupil;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Kileo\Core\MathTask;
use Kileo\Http\Controllers\Controller;
use Kileo\Http\Requests\CreateExerciseRequest;
use Kileo\Models\MathExercise;
use Kileo\Models\Result;

class MathExerciseController extends Controller {

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * The current user.
     *
     * @var Guard
     */
    protected $user;

    /**
     * Create a new controller instance.
     *
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;

        $this->middleware('auth');
        $this->middleware('pupil');

        $this->user = $this->auth->user();
    }

    public function getExerciseSheet($id){
        $exercise = MathExercise::find($id);
        $sheet = $this->generateExerciseSheet($exercise);

        return view('pupil.math', compact('exercise', 'sheet'));
    }

    public function postExerciseSheetResults($id, Request $request){
        $exercise = MathExercise::find($id);

        $result = $this->collectExerciseSheet($exercise, $request);
        $errors = $result['errors'];
        $sheet = $result['sheet'];

        if(count($errors) > 0)
        {
            return view('pupil.math', compact('exercise', 'sheet', 'errors'));
        }

        $correct_results = $this->calculateCorrectResults($sheet);

        $result = new Result();
        $result->exercise_id = $exercise->id;
        $result->user_id = $this->user->id;
        $result->correct_results = $correct_results;
        $result->results = $sheet;
        $result->save();

        return view('pupil.math_result', compact('exercise', 'sheet', 'correct_results'));
    }

    /**
     * Generate a new math exercise sheet.
     *
     * @param $exercise
     * @return array
     */
    protected function generateExerciseSheet($exercise) {

        $sheet = [];
        $canBeZero = $exercise->operation == 4 ? false : true;

        for ($i = 0; $i < $exercise->num_of_calculations; $i++) {

            $num1 = $this->generateNumber($exercise->from, $exercise->to);
            $num2 = $this->generateNumber($exercise->from, $exercise->to, $canBeZero);

            $sheet[$i] = new MathTask($num1, $num2, $exercise->operation);
        }

        return $sheet;

    }

    protected function generateNumber($min, $max, $canBeZero = true){

        $random = rand($min, $max);

        if(!$canBeZero && $random == 0) {
            $this->generateNumber($min, $max, $canBeZero);
        }

        return $random;
    }

    /**
     * Collects the math exercise sheet.
     *
     * @param $exercise
     * @param Request $request
     * @return array
     */
    protected function collectExerciseSheet($exercise, Request $request) {

        $sheet = [];
        $errors = new MessageBag();

        for ($i = 0; $i < $exercise->num_of_calculations; $i++) {

            $num1 = $request->get("task$i-num1");
            $num2 = $request->get("task$i-num2");
            //$operation = $request->get("task$i-operation");
            $result = $request->get("task$i-result");

            $validation = Validator::make(
                array(
                    "task$i-num1"   => $num1,
                    "task$i-num2"   => $num2,
                    "task$i-result" => $result
                ),
                array(
                    "task$i-num1"   => 'required|numeric',
                    "task$i-num2"   => 'required|numeric',
                    "task$i-result" => 'numeric'
                )
            );

            if ( $validation->fails() ) {
                $errors->merge($validation->messages()->toArray());
            }

            $sheet[$i] = new MathTask($num1, $num2, $exercise->operation, $result);
        }

        return [ 'errors' => $errors, 'sheet' => $sheet ];

    }

    /**
     * Calculates the number of correct results of the math exercise sheet.
     *
     * @param $sheet
     * @return array
     */
    protected function calculateCorrectResults($sheet) {

        $correct_results = 0;

        foreach($sheet as $task)
        {
            if ($task->isSolved() && $task->isCorrect())
            {
                $correct_results++;
            }
        }

        return $correct_results;
    }

}