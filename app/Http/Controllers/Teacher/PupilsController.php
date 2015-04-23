<?php namespace Kileo\Http\Controllers\Teacher;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kileo\Http\Controllers\Controller;
use Kileo\Models\SchoolClass;
use Kileo\Models\User;

class PupilsController extends Controller {

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
     * Show create class view
     *
     * @param $classId
     * @return \Illuminate\View\View
     */
    public function create($classId)
    {
        $schoolClass = SchoolClass::find($classId);

        return view('teacher.pupils.create', compact('schoolClass'));
    }

    /**
     * Show the edit view for a school class
     *
     * @param $classId
     * @param $pupilId
     * @return \Illuminate\View\View
     */
    public function edit($classId, $pupilId)
    {
        //$schoolClass = SchoolClass::find($classId);
        //$pupil = User::find($pupilId);

        //return view('teacher.classes.edit', compact('schoolClass', 'pupil'));
    }

    /**
     * Create or Update a school class
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'username' => 'required|max:255|unique:users',
            'password' => 'required|confirmed|min:8'
        ]);

//        $data = $request->only('id','name','username','password');
//
//        $user = Auth::user();
//
//        $schoolClass = SchoolClass::firstOrNew(array('id' => $data['id'], 'user_id' => $user->id));
//        $schoolClass->name = $data['name'];
//
//        $schoolClass->save();
//
//        return redirect()->route('teacher.classes.index');
    }

    /**
     * Remove class
     *
     * @param $classId
     * @param $pupilId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function remove($classId, $pupilId)
    {
//        $user = Auth::user();
//        $schoolClass = SchoolClass::where(array('id' => $classId, 'user_id' => $user->id))->first();
//
//        $schoolClass->delete();
//
//        return redirect()->route('teacher.index');
    }

}