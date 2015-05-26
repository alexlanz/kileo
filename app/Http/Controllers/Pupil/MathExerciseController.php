<?php namespace Kileo\Http\Controllers\Pupil;

use Illuminate\Contracts\Auth\Guard;
use Kileo\Core\MathTask;
use Kileo\Http\Controllers\Controller;
use Kileo\Http\Requests\CreateExerciseRequest;
use Kileo\Models\MathExercise;

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

        //dd($sheet[0]->getNum2());

        return view('pupil.math', compact('exercise', 'sheet'));

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

            $sheet[$i] = new MathTask($num1,$num2,$exercise->operation);
        }

        return $sheet;

    }

    protected function generateNumber($min, $max, $canBeZero = true){

        $random = rand($min, $max);

        if(!$canBeZero && $random == 0){
            $this->generateNumber($min, $max, $canBeZero);
        }

        return $random;
    }


}