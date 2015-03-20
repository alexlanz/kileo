<?php namespace Kileo\Http\Controllers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\RedirectResponse;

class HomeController extends Controller {

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
    }

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user = $this->auth->user();

        switch ($user->type)
        {
            case 'teacher':
                return new RedirectResponse(route('teacher.index'));
            case 'pupil':
                return new RedirectResponse(route('pupil.index'));
            default:
                $this->auth->logout();
                return new RedirectResponse(route('login.show'));
        }
	}

}
