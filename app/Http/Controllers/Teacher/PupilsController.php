<?php namespace Kileo\Http\Controllers\Teacher;

use Illuminate\Contracts\Auth\Guard;
use Kileo\Http\Controllers\Controller;
use Kileo\Http\Requests\PupilPasswordRequest;
use Kileo\Http\Requests\PupilRequest;
use Kileo\Http\Requests\PupilShortRequest;
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
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($class)
    {
        $schoolClass = SchoolClass::where('id', $class)->where('user_id', $this->user->id)->first();

        if ( ! $schoolClass)
        {
            abort(404, 'School class not found.');
        }

        return view('teacher.pupils.create', compact('schoolClass'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PupilRequest $request
     * @param $class
     * @return Response
     */
    public function store(PupilRequest $request, $class)
    {
        $data = $request->only('id','name','username','password');

        $schoolClass = SchoolClass::where('id', $class)->where('user_id', $this->user->id)->first();

        if ( ! $schoolClass)
        {
            abort(404, 'School class not found.');
        }

        $pupil = new User();
        $pupil->name = $data['name'];
        $pupil->username = $data['username'];
        $pupil->password = $data['password'];
        $pupil->type = 'pupil';
        $pupil->schoolClass()->associate($schoolClass);
        $pupil->save();

        return redirect()->route('teacher.classes.show', $class);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $class
     * @param $pupil
     * @return Response
     */
    public function edit($class, $pupil)
    {
        $schoolClass = SchoolClass::where('id', $class)->where('user_id', $this->user->id)->first();

        if ( ! $schoolClass)
        {
            abort(404, 'School class not found.');
        }

        $pupil = User::where('id', $pupil)->where('school_class_id', $class)->first();

        if ( ! $pupil)
        {
            abort(404, 'Pupil for this class not found.');
        }

        return view('teacher.pupils.edit', compact('schoolClass', 'pupil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PupilShortRequest $request
     * @param $class
     * @param $pupil
     * @return Response
     */
    public function update(PupilShortRequest $request, $class, $pupil)
    {
        $data = $request->only('name');

        $pupilUser = User::where('id', $pupil)->where('school_class_id', $class)->first();

        if ( ! $pupilUser)
        {
            abort(404, 'Pupil for this class not found.');
        }

        $pupilUser->name = $data['name'];
        $pupilUser->save();

        return redirect()->route('teacher.classes.show', $class);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $class
     * @param $pupil
     * @return Response
     */
    public function destroy($class, $pupil)
    {
        $pupilUser = User::where('id', $pupil)->where('school_class_id', $class)->first();

        if ( ! $pupilUser)
        {
            abort(404, 'Pupil for this class not found.');
        }

        $pupilUser->delete();

        return redirect()->route('teacher.classes.show', $class);
    }

    /**
     * Show the form for editing the password of a specified resource.
     *
     * @param $class
     * @param $pupil
     * @return Response
     */
    public function showPassword($class, $pupil)
    {
        $schoolClass = SchoolClass::where('id', $class)->where('user_id', $this->user->id)->first();

        if ( ! $schoolClass)
        {
            abort(404, 'School class not found.');
        }

        $pupil = User::where('id', $pupil)->where('school_class_id', $class)->first();

        if ( ! $pupil)
        {
            abort(404, 'Pupil for this class not found.');
        }

        return view('teacher.pupils.password', compact('schoolClass', 'pupil'));
    }

    /**
     * Update the password of a specified resource in storage.
     *
     * @param PupilPasswordRequest $request
     * @param $class
     * @param $pupil
     * @return Response
     */
    public function changePassword(PupilPasswordRequest $request, $class, $pupil)
    {
        $data = $request->only('password');

        $pupilUser = User::where('id', $pupil)->where('school_class_id', $class)->first();

        if ( ! $pupilUser)
        {
            abort(404, 'Pupil for this class not found.');
        }

        $pupilUser->password = $data['password'];
        $pupilUser->save();

        return redirect()->route('teacher.classes.show', $class);
    }

}