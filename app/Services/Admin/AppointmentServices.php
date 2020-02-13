<?php

namespace App\Services\Admin;

use App\Appointment;
use Illuminate\Http\Request;
use App\Services\TransformerService;

class AppointmentServices extends TransformerService{

	public function all(Request $request){
		$sort = $request->sort ? $request->sort : 'created_at'; //last parameter is the default
	    $order = $request->order ? $request->order : 'desc';
	    $limit = $request->limit ? $request->limit : 10;
	    $offset = $request->offset ? $request->offset : 0;
	    $query = $request->search ? $request->search : '';

	    $appointment = Appointment::where('date', 'like', "%{$query}%")->orderBy($sort, $order);
	    $listCount = $appointment->count();

	    $appointment = $appointment->limit($limit)->offset($offset)->get();

	    return respond(['rows' => $appointment, 'total' => $listCount]);
	}

	public function update(Request $request, Appointment $appointment) {
    $data = $request->validate([
      'time' => 'required',
      'date' => 'required',
      'staff_service_id' => 'required',
      'branch_id' => 'required',
      'user_id' => 'required',
      'code' => 'required'
    ]);
    // dd($data['date']);
    $appointment->date = $data['date']; 
    $appointment->time = $data['time'];
    $appointment->staff_service_id = $data['staff_service_id'];
    $appointment->branch_id = $data['branch_id'];
    $appointment->user_id = $data['user_id'];
    $appointment->code = $data['code'];
    $appointment->save();

    return redirect()->route('admin.appointments.index'); 
  }



	public function transform($appointment){
		return [
			'time' => $appointment->time,
			'date' => $appoinment->date,
			'staff_service_id' => $appointment->staff_service_id,
			'branch_id' => $appointment->branch_id,
			'user_id' => $appointment->user_id,
			'code' =>$appointment->code
		];
	}
}
