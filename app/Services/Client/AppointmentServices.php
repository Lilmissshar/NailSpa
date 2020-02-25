<?php

namespace App\Services\Client;

use App\Appointment;
use App\Service;
use App\Staff;
use Auth;
use Illuminate\Http\Request;
use App\Services\TransformerService;
use Carbon\Carbon;

class AppointmentServices extends TransformerService{

	protected $path = 'client.appointments.';

	public function index(Request $request, Service $service, Staff $staff){
		$date = $request->date ? Carbon::createFromFormat('d/m/Y', $request->date) : Carbon::now();
	    $date = $date->toDateString();
	    //the requested date is in carbon form in the format of d/m/y. but the comparison must be in the format of 2020-mm-dd. so the toDateString will make it similar. 
	    $appointments =  Appointment::where('staff_id', $staff->id)->where('date', $date)->get();
	    
	    if($request->wantsJson()) {
	      return response($appointments, 200);
	    }
	    
	  	return view($this->path . 'index', ['staff' => $staff, 'service' => $service, 'appointments' => $appointments]);
	  }

	public function store(Request $request, Service $service, Staff $staff) {
		$detail = [
	      'service' => $service,
	      'staff' => $staff
	    ];

	    $date = Carbon::createFromFormat('d/m/Y', $request->date);
	    $date = $date->toDateString();

		$appointment = new Appointment();
		$appointment->time = $request->time;
		$appointment->date = $date;
		$appointment->staff_id = $staff->id;
		$appointment->customer_id = current_user()->id;
		$appointment->duration = $service->duration;
		$appointment->status = "ongoing";
		$appointment->save();
		// dd('success');
		// return response()->json(array('success' => true, 'last_insert_id' => $appointment->id), 200);
		return redirect()->route('home');

	}

	public function transform($appointment){
		return [
			'time' => $appointment->time,
			'date' => $appointment->date,

		];
	}
}