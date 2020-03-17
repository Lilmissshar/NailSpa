<?php

namespace App\Http\Controllers\Client;

use App\Staff;
use App\Service;
use App\Appointment;
use App\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Client\DetailServices;

class DetailsController extends Controller{

	protected $path = 'client.details.';
  protected $detailServices;

  public function __construct(DetailServices $detailServices){
    $this->detailServices = $detailServices;
  }
	
  public function index(Request $request, Service $service, Staff $staff){ 
    $data = [
      'service' => $service, 
      'staff' => $staff, 
      'time' => $request->time, 
      'date' => $request->date

    ];
		if ($request->wantsJson()) {
      return route('details.index', $data);
    }

    return view($this->path . 'index', $data);
  }

  public function submitForm(Request $request, Service $service, Staff $staff){
    return $this->detailServices->store($request, $service, $staff);
  }

  public function signIn(Request $request, Service $service, Staff $staff){
    $data = [
      'service' => $service,
      'staff' => $staff,
      'time' => $request->time,
      'date' => $request->date
    ];
    if ($request->wantsJson()) {
      return route('details.signIn', $data);
    }

    return view($this->path . 'show', $data);
  }

  public function submitSignIn(Request $request, Service $service, Staff $staff){
    return $this->detailServices->storeSignIn($request, $service, $staff);
  }
}