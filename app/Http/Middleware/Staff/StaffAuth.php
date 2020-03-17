<?php

namespace App\Http\Middleware\Staff;

use Closure;
use Illuminate\Support\Facades\Auth;

class StaffAuth{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next, $guard = null){
		if (Auth::guard($guard)->check()) {
			return $next($request);
		}
		return redirect()->route('staff.login.show');

  }
}
