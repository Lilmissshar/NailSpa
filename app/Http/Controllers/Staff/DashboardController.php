<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller{

	protected $path = 'staff.dashboard.';

	public function dashboard(){
		return view($this->path . 'index');
	}
}