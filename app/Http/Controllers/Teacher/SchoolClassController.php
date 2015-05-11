<?php namespace Kileo\Http\Controllers\Teacher;

use Illuminate\Contracts\Auth\Guard;
use Kileo\Http\Controllers\Controller;
use Kileo\Http\Requests\SchoolClassRequest;
use Kileo\Models\SchoolClass;

class SchoolClassController extends Controller {

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
    public function create()
    {
        return view('teacher.classes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SchoolClassRequest $request
     * @return Response
     */
    public function store(SchoolClassRequest $request)
    {
        $data = $request->only('id','name');

        $schoolClass = new SchoolClass();
        $schoolClass->name = $data['name'];
        $schoolClass->teacher()->associate($this->user);
        $schoolClass->save();

        return redirect()->route('teacher.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $schoolClass = SchoolClass::findOrFail($id);

        return view('teacher.classes.edit', compact('schoolClass'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SchoolClassRequest $request
     * @param  int $id
     * @return Response
     */
    public function update(SchoolClassRequest $request, $id)
    {
        $data = $request->only('id','name');

        $schoolClass = SchoolClass::where('id', $id)->where('user_id', $this->user->id)->first();

        if ( ! $schoolClass)
        {
            abort(404, 'School class not found.');
        }

        $schoolClass->name = $data['name'];
        $schoolClass->save();

        return redirect()->route('teacher.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $schoolClass = SchoolClass::where('id', $id)->where('user_id', $this->user->id)->first();

        if ( ! $schoolClass)
        {
            abort(404, 'School class not found.');
        }

        $schoolClass->delete();

        return redirect()->route('teacher.index');
    }

}