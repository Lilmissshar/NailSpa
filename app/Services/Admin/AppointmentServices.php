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

	 public function transformCustomer($customer) {
	 	return $customer->name;
	 }

	 public function transformStaff($staff) {
	 	return $staff->name;
	}

	public function transform($appointment){
		return [
			'id' => $appointment->id,
			'time' => $appointment->time,
			'date' => $appointment->date,
			'duration' => $appointment->duration,
			'status' =>$appointment->status,
			'customer_id' => $this->transformCustomer($appointment->customer),
			'staff_id' => $this->transformStaff($appointment->staff)
		];
	}
}
