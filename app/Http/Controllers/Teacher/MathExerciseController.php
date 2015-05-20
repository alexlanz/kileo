<?php namespace Kileo\Http\Controllers\Teacher;

use Illuminate\Contracts\Auth\Guard;
use Kileo\Http\Controllers\Controller;
use Kileo\Http\Requests\ExerciseRequest;
use Kileo\Http\Requests\CreateExerciseRequest;
use Kileo\Models\SchoolClass;
use Kileo\Models\Exercise;
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
        $this->middleware('teacher');

        $this->user = $this->auth->user();
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param ExerciseRequest $request
     * @param $class
     * @return Response
     */
    public function store(ExerciseRequest $request, $class, $exercise)
    {
        $data = $request->only('from','to','num_of_calculations', 'operation');

        $math_exercise = new MathExercise();
        $math_exercise->id = $exercise->id;
        $math_exercise->from = $data['from'];
        $math_exercise->to = $data['to'];
        $math_exercise->num_of_calculations = $data['num_of_calculations'];        
        $math_exercise->operation = $data['operation'];
        $math_exercise->exercise()->associate($exercise);
        $math_exercise->save();

        return redirect()->route('teacher.classes.exercises.index', $class);
    }
    
    public function findConcreteExercise($id)
    {
        return MathExercise::find($id);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param ExerciseRequest $request
     * @param $class
     * @param $exercise
     * @return Response
     */
    public function update(ExerciseRequest $request, $class, $exercise)
    {
        $data = $request->only('from','to','num_of_calculations', 'operation');
        
        $exercise = MathExercise::find($exercise->id);

        if ( ! $exercise)
        {
            abort(404, 'MathExercise for this class not found.');
        }

        $exercise->from = $data['from'];
        $exercise->to = $data['to'];
        $exercise->num_of_calculations = $data['num_of_calculations'];
        $exercise->operation = $data['operation'];
        
        $exercise->save();

        return redirect()->route('teacher.classes.exercises.index', $class);
    }    
    
}