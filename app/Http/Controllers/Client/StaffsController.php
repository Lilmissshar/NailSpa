<?php

namespace App\Http\Controllers\Client;

use App\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StaffsController extends Controller{

	protected $path = 'client.staffs.';
	
  public function index(Service $service){	
  	return view($this->path . 'index', ['service' => $service, 'staffs' => $service->staffs]);
  }
}

