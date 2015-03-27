<?php namespace Kileo\Http\Controllers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kileo\SchoolClass;

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
        $classes = Auth::user()->classes;

        return view('teacher.index', compact('classes'));
    }


    /**
     * Show create class view
     *
     * @return \Illuminate\View\View
     */
    public function createClass()
    {
        return view('teacher.createclass');
    }


    /**
     * Create or Update a school class
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function storeClass(Request $request)
    {
        $this->validate($request, [
            'name' => 'required | max:255'
        ]);

        $data = $request->only('id','name');
        $user = Auth::user();

        $schoolClass = SchoolClass::firstOrNew(array('id' => $data['id'], 'user_id' => $user->id));
        $schoolClass->name = $data['name'];

        $schoolClass->save();

        return redirect('teacher');
    }


    /**
     * Show the edit view for a school class
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function editClass($id)
    {
        $schoolClass = SchoolClass::find($id);

        return view('teacher.editclass', compact('schoolClass'));
    }


    /**
     * Remove class
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function removeClass($id)
    {
        $user = Auth::user();
        $schoolClass = SchoolClass::where(array('user_id' => $user->id, 'id' => $id))->first();

        $schoolClass->delete();

        return redirect('teacher');
    }

}