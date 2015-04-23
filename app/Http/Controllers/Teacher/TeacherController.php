<?php namespace Kileo\Http\Controllers\Teacher;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Kileo\Http\Controllers\Controller;

class TeacherController extends Controller {

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

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
    }


    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schoolClasses = Auth::user()->schoolClasses;

        return view('teacher.index', compact('schoolClasses'));
    }

}