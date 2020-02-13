<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Branch;
use App\Services\Client\LocationServices;

class LocationController extends Controller{

	protected $path = 'client.';

	public function index(){
		return view($this->path . 'location');
	}
}
