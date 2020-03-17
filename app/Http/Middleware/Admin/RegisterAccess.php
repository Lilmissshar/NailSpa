<?php

namespace App\Http\Middleware\Admin;

use Closure;
use App\Admin;

class RegisterAccess{

  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next){
    $admin = Admin::first();

    if($admin) {
      return redirect()->route('admin.login.show');
    }

		return $next($request);
  }
}
