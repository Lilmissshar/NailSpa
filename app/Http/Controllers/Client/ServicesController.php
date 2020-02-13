<?php

namespace App\Http\Controllers\Client;

use App\Service;
use App\Branch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServicesController extends Controller{

	protected $path = 'client.services.';
	
  public function index(Branch $branch){
		$services = Service::where('branch_id', $branch->id)->get();

  	return view($this->path . 'index', ['branch' => $branch, 'services' => $services]);
  }

  // public function show($id){
  // 	$service = Service::where('id', $id)->first();
  // 	//first is for object
  // 	//get is for array 
  // 	return view($this->path . 'show', ['service' => $service]);
  // }
}

