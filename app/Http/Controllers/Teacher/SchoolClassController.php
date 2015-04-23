<?php namespace Kileo\Http\Controllers\Teacher;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kileo\Http\Controllers\Controller;
use Kileo\Models\SchoolClass;

class SchoolClassController extends Controller {

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
     * Show the school class
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function index($id)
    {
        $schoolClass = SchoolClass::find($id);

        return view('teacher.classes.index', compact('schoolClass'));
    }

    /**
     * Show create class view
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('teacher.classes.create');
    }

    /**
     * Show the edit view for a school class
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $schoolClass = SchoolClass::find($id);

        return view('teacher.classes.edit', compact('schoolClass'));
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
            'name' => 'required|max:255'
        ]);

        $data = $request->only('id','name');
        $user = Auth::user();

        $schoolClass = SchoolClass::firstOrNew(array('id' => $data['id'], 'user_id' => $user->id));
        $schoolClass->name = $data['name'];

        $schoolClass->save();

        return redirect()->route('teacher.index');
    }

    /**
     * Remove class
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function remove($id)
    {
        $user = Auth::user();
        $schoolClass = SchoolClass::where(array('id' => $id, 'user_id' => $user->id))->first();

        $schoolClass->delete();

        return redirect()->route('teacher.index');
    }

}