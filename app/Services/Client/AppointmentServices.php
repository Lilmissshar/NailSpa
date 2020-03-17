<?php

namespace App\Services\Client;

use App\Appointment;
use App\Service;
use App\Staff;
use App\ServiceStaff;
use Auth;
use Illuminate\Http\Request;
use App\Services\TransformerService;
use Carbon\Carbon;

use Illuminate\Pagination\Paginator;

class AppointmentServices extends TransformerService{

	protected $path = 'client.appointments.';

	public function index(Request $request, Service $service, Staff $staff){
		$date = $request->date ? Carbon::createFromFormat('d/m/Y', $request->date) : Carbon::now();
	    $date = $date->toDateString();
	    //the requested date is in carbon form in the format of d/m/y. but the comparison must be in the format of 2020-mm-dd. so the toDateString will make it similar. 
	    $serviceStaffId = ServiceStaff::where('staff_id', $staff->id)->where('service_id', $service->id)->first();
	    // dd($serviceStaffId);
	    $appointments =  Appointment::where('service_staff_id', $serviceStaffId->id)->where('date', $date)->get();
	    
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

	    $serviceStaffId = ServiceStaff::where('staff_id', $staff->id)->where('service_id', $service->id)->first();

	    $date = Carbon::createFromFormat('d/m/Y', $request->date);
	    $date = $date->toDateString();

		$appointment = new Appointment();
		$appointment->time = $request->time;
		$appointment->date = $date;
		$appointment->service_staff_id = $serviceStaffId->id;
		$appointment->customer_id = current_user()->id;
		$appointment->duration = $service->duration;
		$appointment->status = "5";
		$appointment->save();
		// dd('success');
		// return response()->json(array('success' => true, 'last_insert_id' => $appointment->id), 200);
		return redirect()->route('home');

	}

	public function showAppointments(){
		$appointments = Appointment::where('customer_id', current_user()->id)->paginate(10);
		dd($appointments);
		$appointments->getCollection()->transform(function ($appointment) {
	    return $this->transform($appointment);
		});

		return view($this->path . 'showAppointments', ['appointments' => $appointments]);
	}

	public function update(Request $request, Appointment $appointment){
		$data = $request->validate([
			'description' => 'required'	
		]);

		$appointment->review->description = $data['description'];
		$appointment->review->save();

		return redirect()->route('appointments.showAppointments');
	}

	public function transformReview($review) {
		if ($review){
			return $review->description;
		} 

		return '-';
	}

	public function status($appointment){
		switch($appointment->status){
			case "0":
			return "Cancelled";
			break;

			case "1":
			return "Ongoing";
			break;

			case "2":
			return "Completed";
			break;

			case "3":
			return "Accepted";
			break;

			case "4":
			return "Rejected";
			break;

			case "5":
			return "Pending";
			break;

			default:
			return "Pending";
		}
	}

	public function transform($appointment){
		return [
			'id' => $appointment->id,
			'time' => $appointment->time,
			'date' => $appointment->date,
			'service' => $appointment->service_staff->service->name,
			'staff' => $appointment->service_staff->staff->name,
			'status' => $this->status($appointment),
			'review' => $this->transformReview($appointment->review)
		];
	}
}