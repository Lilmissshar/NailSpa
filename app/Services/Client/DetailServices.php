<?php

namespace App\Services\Client;

use App\Appointment;
use App\User;
use App\Branch;
use App\Service;
use App\Staff;
use App\StaffService;
use Auth;
use Illuminate\Http\Request;
use App\Services\TransformerService;

class DetailServices extends TransformerService{

	public function all(Request $request){
		$appointment = Appointment::all();

		return response()->json($this->transformCollection($appointment));
	}

	public function store(Request $request, Branch $branch, Service $service, Staff $staff) {
		$detail = [
	      'branch' => $branch,
	      'service' => $service,
	      'staff' => $staff
	    ];
	    // dd($detail['date']);

		$data = $request->validate([
			"name" => "required",
			"email" => "required|email|unique:users",
			"password" => "required"
		]);

		$staffServiceId = StaffService::where('staff_id', $staff->id)->where('service_id', $service->id)->first();
		// dd($staffServiceId->id);

		$customer = new User();
		$customer->name = $request->name;
		$customer->email = $request->email;
		$customer->phone = $request->phone;
		$customer->password = $request->password;
		$customer->role = 0;
		$customer->save();
		// dd($customer->id);
		// dd($request);

		$appointment = new Appointment();
		$appointment->time = $request->time;
		$appointment->date = $request->date;
		$appointment->staff_service_id = $staffServiceId->id;
		$appointment->branch_id = $branch->id;
		$appointment->user_id = $customer->id;
		$appointment->save();
		// dd('success');
		// return response()->json(array('success' => true, 'last_insert_id' => $appointment->id), 200);
		return redirect()->route('payments.index', $appointment);

	}

	public function storeSignIn(Request $request, Branch $branch, Service $service, Staff $staff) {
		$detail = [
	      'branch' => $branch,
	      'service' => $service,
	      'staff' => $staff,
	      'time' => $request->time,
	      'date' => $request->date
	    ];

		$data = $request->validate([
			"email" => "required",
			"password" => "required"
		]);

		$staffServiceId = StaffService::where('staff_id', $staff->id)->where('service_id', $service->id)->first();

		if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => 0])) {
			$appointment = new Appointment();
			$appointment->time = $detail['time'];
			$appointment->date = $detail['date'];
			$appointment->staff_service_id = $staffServiceId->id;
			$appointment->branch_id = $branch->id;
			$appointment->user_id = current_user()->id;
			$appointment->save();
			dd('successs');
			return redirect()->route('details.index', $detail);
		} else {
			// dd('unsuccessful');
			return redirect()->back()->withErrors(['message' => 'Email or password is incorrect']);
		}
	}

	public function transform($appointment){
		return [
			'time' => $appointment->time,
			'date' => $appointment->date,

		];
	}
}