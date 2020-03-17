<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller{
	public function viewRegister(){
    	return view('admin.auth.register');
  	}

  public function register(Request $request){
    $this->validate($request, [
      "email" => "required|email|unique:admins",
      "name" => "required",
      "password" => "required",
      "mobile" => "required"
    ]);

    $admin = Admin::create([
  	  'name' => $request->name,
  	  'email' => $request->email,
  	  'password' => Hash::make($request->password),
  	  'mobile' => $request->mobile
    ]);
  
    Auth::guard('admin')->login($admin);

    return redirect()->route('dashboard');
	}

	public function viewLogin(){
	  return view('admin.auth.login');
	}

	public function login(Request $request){
	  $this->validate($request, [
	    "email" => "required|email",
	    "password" => "required"
	  ]);

	  if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
	    return redirect()->route('dashboard');
	  }

	  return redirect()->back()->withErrors(['message' => 'Email or password is incorrect']);	
	}

	public function logout(){
	  Auth::logout();

	  return redirect()->route('admin.login.show');
	}
}