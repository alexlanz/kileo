<?php namespace Kileo\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\RedirectResponse;

class Teacher {

	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard $auth
     */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        $user = $this->auth->user();

		if ($user->type !== 'teacher')
		{
            return new RedirectResponse(url('/'));
		}

		return $next($request);
	}

}
