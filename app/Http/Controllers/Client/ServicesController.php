<?php

namespace App\Http\Controllers\Client;

use App\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServicesController extends Controller{

	protected $path = 'client.services.';
	
  public function index(){
    $services = Service::all();

  	return view($this->path . 'index', ['services' => $services]);
  }
}

