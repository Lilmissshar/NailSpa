<?php

namespace App\Services\Staff;

use App\Appointment;
use App\ServiceStaff;
use Illuminate\Http\Request;
use App\Services\TransformerService;

class AppointmentServices extends TransformerService{
	public function index(Request $request){

		$sort = $request->sort ? $request->sort : 'created_at'; //last parameter is the default
    $order = $request->order ? $request->order : 'desc';
    $limit = $request->limit ? $request->limit : 10;
    $offset = $request->offset ? $request->offset : 0;
    $query = $request->search ? $request->search : '';

    // $staffServiceIds = ServiceStaff::where('staff_id', current_user()->id)->get();
    // foreach($staffServiceIds as $staffServiceId) {
    // 	dd($staffServiceId->service_id);
    // }

    $appointments = Appointment::where('date', 'like', "%{$query}%")->whereHas('service_staff', function($appointments) {
    	$appointments->where('staff_id', current_user()->id);
    })->orderBy($sort, $order);

    $listCount = $appointments->count();

    $appointments = $appointments->limit($limit)->offset($offset)->get();
   
    return respond(['rows' => $this->transformCollection($appointments), 'total' => $listCount]);
	}

	public function update(Request $request, Appointment $appointments) {
		$data = $request->validate([
			'status' => 'required'
		]);
		$appointments->status = $data['status'];
		$appointments->save();

		return redirect()->route('staff.appointments.index');	
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
			'customer_name' => $appointment->customer->name,
			'customer_email' => $appointment->customer->email,
			'status' => $this->status($appointment),
			'service' => $appointment->service_staff->service->name
		];
	}
}