<?php

namespace App\Services\Admin;

use App\Appointment;
use Illuminate\Http\Request;
use App\Services\TransformerService;

class AppointmentServices extends TransformerService{

	public function all(Request $request){
		$sort = $request->sort ? $request->sort : 'created_at'; 
	    $order = $request->order ? $request->order : 'desc';
	    $limit = $request->limit ? $request->limit : 10;
	    $offset = $request->offset ? $request->offset : 0;
	    $query = $request->search ? $request->search : '';

	    $appointments = Appointment::where('date', 'like', "%{$query}%")->orderBy($sort, $order);
	    $listCount = $appointments->count();

	    $appointments = $appointments->limit($limit)->offset($offset)->get();

	    return respond(['rows' => $this->transformCollection($appointments), 'total' => $listCount]);
	}

	public function update(Request $request, Appointment $appointments) {
	    $data = $request->validate([
	      "status" => "required"
	    ]);
	    
	    $appointments->status = $data['status'];
	    $appointments->save();

	    return redirect()->route('admin.appointments.index'); 
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
			$appointment->service_staff->staff->name = null;
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
			'duration' => $appointment->duration,
			'status' =>$this->status($appointment),
			'customer_id' => $appointment->customer->name,
			'staff_name' => $appointment->service_staff->staff->name
		];
	}
}
