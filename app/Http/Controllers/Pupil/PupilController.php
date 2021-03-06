<?php namespace Kileo\Http\Controllers\Pupil;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Kileo\Http\Controllers\Controller;

class PupilController extends Controller {

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
        $this->middleware('pupil');
    }


    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $schoolClass = Auth::user()->schoolClass;
        $exercises = $schoolClass->exercises;

        return view('pupil.index', compact('exercises'));
    }

}