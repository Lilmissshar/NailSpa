<?php

namespace App\Http\Controllers\Client;

use App\Appointment;
use App\Staff;
use App\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Client\AppointmentServices;

class AppointmentsController extends Controller{

  protected $path = 'client.appointments.';
  protected $appointmentServices;

  public function __construct(AppointmentServices $appointmentServices){
    $this->appointmentServices = $appointmentServices;
  }
	
  public function index(Request $request, Service $service, Staff $staff){
    return $this->appointmentServices->index($request, $service, $staff);
  }

  public function show(Request $request, Service $service, Staff $staff){
  	$data = [
      'service' => $service, 
      'staff' => $staff, 
      'time' => $request->time, 
      'date' => $request->date

    ];
		if ($request->wantsJson()) {
      return route('appointments.show', $data);
    }

    return view($this->path . 'show', $data);
  }

  public function submitForm(Request $request, Service $service, Staff $staff){
    return $this->appointmentServices->store($request, $service, $staff);
  }

  public function signIn(Request $request, Service $service, Staff $staff){
    $data = [
      'service' => $service,
      'staff' => $staff,
      'time' => $request->time,
      'date' => $request->date
    ];
    if ($request->wantsJson()) {
      return route('appointments.details', $data);
    }

    return view($this->path . 'details', $data);
  }

  public function submitSignIn(Request $request, Service $service, Staff $staff){
    return $this->appointmentServices->storeSignIn($request, $service, $staff);
  }

  public function showAppointments(){
    return $this->appointmentServices->showAppointments();
  }

  public function edit(Appointment $appointment){
    return view($this->path . 'edit', ['appointment' => $appointment]);
  }

  public function update(Request $request, Appointment $appointment){
    return $this->appointmentServices->update($request, $appointment);
  }
}

