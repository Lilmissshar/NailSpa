<?php

namespace App\Http\Middleware\Staff;

use Closure;
use App\Staff;

class RegisterAccess{

  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next){
    $staff = Staff::first();

    if($staff) {
      return redirect()->route('staff.login.show');
    }

		return $next($request);
  }
}
