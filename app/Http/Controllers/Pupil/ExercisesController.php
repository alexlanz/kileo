<?php namespace Kileo\Http\Controllers\Pupil;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Kileo\Http\Controllers\Controller;
use Kileo\Models\Exercise;
use DB;

class ExercisesController extends Controller {

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


    /**
     * Show the form for doing the specified exercise.
     *
     * @param $id
     * @return Response
     */
    public function show($id)
    {
        $exercise = Exercise::where('id', $id)->first();

        if ( ! $exercise)
        {
            abort(404, 'Exercise not found.');
        }

        $controller = $this->getConcreteExerciseController($exercise->type);

        return $controller->getExerciseSheet($exercise->id);
    }

    /**
     * Post the results of a specified exercise.
     *
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function post(Request $request, $id)
    {
        $exercise = Exercise::where('id', $id)->first();

        if ( ! $exercise)
        {
            abort(404, 'Exercise not found.');
        }

        $controller = $this->getConcreteExerciseController($exercise->type);

        return $controller->postExerciseSheetResults($exercise->id, $request);
    }


    /**
     * @param $type
     * @return MathExerciseController|void
     */
    private function getConcreteExerciseController($type)
    {
        switch($type)
        {
            case "math":
                return new MathExerciseController($this->auth);
            default:
                return abort(404, 'Exercise type does not exist.');
        }
    }

}