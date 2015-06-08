<?php namespace Kileo\Http\Controllers\Teacher;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Config;
use Illuminate\Html\HtmlServiceProvider;
use Kileo\Http\Controllers\Controller;
use Kileo\Http\Requests\ExerciseRequest;
use Kileo\Models\SchoolClass;
use Kileo\Models\Exercise;
use Kileo\Models\Result;
use DB;


class ExercisesResultsController extends Controller {

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
     * Display all resources.
     *
     * @param  int  $class_id
     * @param  int  $exercise_id
     * @return Response
     */
    public function index($class_id, $exercise_id)
    {
        $exercise = Exercise::where('id', $exercise_id)->where('school_class_id', $class_id)->first();

        $results = Result::where('exercise_id', $exercise_id)->get();

        return view('teacher.exercises.results.index', compact('exercise', 'results'));
    }
}