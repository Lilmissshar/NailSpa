<?php

namespace App\Http\Controllers\Staff;

use App\Staff;
use Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller{
	// public function viewRegister(){
	// 	return view('staff.auth.register');
	// }

	// public function register(Request $request){
	// 	$this->validate($request, [
	// 		"name" => "required",
	// 		"description" => "required",
	// 		"age" => "required",
	// 		"mobile" => "required",
	// 		"email" => "required|email|unique:staffs",
	// 		"password" => "required|min:6|required_with:password_confirmation|same:password_confirmation",
	// 		"password_confirmation" => "min:6"
	// 	]);

	// 	$staff = Staff::create([
	// 		'name' => $request->name,
	// 		'description' => $request->description,
	// 		'age' => $request->age,
	// 		'mobile' => $request->mobile,
	// 		'email' => $request->email,
	// 		'password' => Hash::make($request->password)
	// 	]);

	// 	Auth::guard('staff')->login($staff);

	// 	return redirect()->route('staff.dashboard');
	// }

	public function viewLogin() {
		return view('staff.auth.login');
	}

	public function login(Request $request) {
		$this->validate($request, [
			'email' => 'required|email',
			'password' => 'required'
		]);

		if (Auth::guard('staff')->attempt(['email' => $request->email, 'password' => $request->password])) {
			return redirect()->route('staff.dashboard');
		} else {
			return redirect()->back()->withErrors(['message' => 'Email or password is incorrect']);
		}
	}

	public function logout() {
		Auth::logout();

		return redirect()->route('staff.dashboard');
	}

}