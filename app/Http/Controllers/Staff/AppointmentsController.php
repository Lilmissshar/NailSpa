<?php

namespace App\Http\Controllers\Staff;

use App\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Staff\AppointmentServices;

class AppointmentsController extends Controller{

	protected $path = 'staff.appointments.';
	protected $appointmentServices;

	public function __construct(AppointmentServices $appointmentServices){
		$this->appointmentServices = $appointmentServices;
	}

	public function index(Request $request){
		if ($request->isJson()) {
			return $this->appointmentServices->index($request);
		}
		return view($this->path . 'index');
	}

	public function edit(Appointment $appointment){
		return view($this->path . 'edit', ['appointment' => $appointment, 'customer' => $appointment->customer, 'service' => $appointment->service_staff->service]);
	}

	public function update(Request $request, Appointment $appointment){
		return $this->appointmentServices->update($request, $appointment);
	}
}