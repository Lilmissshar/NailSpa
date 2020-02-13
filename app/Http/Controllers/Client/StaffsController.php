<?php

namespace App\Http\Controllers\Client;

use App\Staff;
use App\Branch;
use App\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StaffsController extends Controller{

	protected $path = 'client.staffs.';
	
  public function index(Branch $branch, Service $service){
		$staffs = Staff::where('branch_id', $branch->id)->whereHas('service', function($query) use ($service) {
      $query->where('service_id', $service->id);
    })->get();

  	return view($this->path . 'index', ['branch' => $branch, 'service' => $service, 'staffs' => $staffs]);
  }
}

