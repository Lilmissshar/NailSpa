<?php

namespace App\Http\Controllers\Admin;

use App\Appointment;
use App\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\AppointmentServices;

class AppointmentsController extends Controller{

	protected $path = 'admin.appointments.';
	protected $appointmentServices;

	public function __construct(AppointmentServices $appointmentServices){
		$this->appointmentServices = $appointmentServices;
	}

  public function index(Request $request){
		if ($request->isJson()) {
			return $this->appointmentServices->all($request);
	   }
		return view($this->path . 'index');
  }

  public function edit(Appointment $appointment){
    $serviceStaff = $appointment->service_staff->staff->pluck('name', 'id');
    $customer = Customer::pluck('name', 'id');
    return view($this->path . 'edit', ['appointment' => $appointment, 'serviceStaff' => $serviceStaff, 'customer' => $customer]); 
  }

  public function update(Request $request, Appointment $appointment) {
    return $this->appointmentServices->update($request, $appointment);
  }

  public function destroy(Appointment $appointment){
    $appointment->delete();

		return success();
  }
}
