<?php

namespace App\Http\Controllers\Client;

use App\Customer;
use Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller{
	public function viewRegister(){
		return view('client.auth.register');
	}

	public function register(Request $request){
		$this->validate($request, [
	      "email" => "required|email|unique:customers",
	      "name" => "required",
	      "mobile" => "required",
	      "password" => "required|min:6|required_with:password_confirmation|same:password_confirmation",
	      "password_confirmation" => "min:6"
	    ]);

		$customer = Customer::create([
			'name' => $request->name,
			'email' => $request->email,
			'mobile' => $request->mobile,
			'password' => Hash::make($request->password),
			"is_active" => 1
		]);

		Auth::login($customer);

		return redirect()->intended();
	}

	public function viewLogin() {
		return view('client.auth.login');
	}

	public function login(Request $request) {
		$this->validate($request, [
			'email' => 'required|email',
			'password' => 'required'
		]);

		if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
			dd($request);
			return redirect()->intended();
	 	} else{
	    return redirect()->back()->withErrors(['message' => 'Email or password is incorrect']);
		}
	}

	public function logout() {
	  Auth::logout();

	  return redirect()->route('home');
	}
}
