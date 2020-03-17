<?php

namespace App\Services\Client;

use App\Review;
use App\Appointment;
use Illuminate\Http\Request;
use App\Services\TransformerService;

class ReviewServices extends TransformerService{

	public function store(Request $request, Appointment $appointment){
		$data = $request->validate([
			'description' => 'required'
		]);

		$review = new Review();
		$review->appointment_id = $appointment->id;
		$review->description = $request->description;
		$review->save();

		return \App::call('App\Http\Controllers\Client\AppointmentsController@showAppointments');
	}

	public function transform($review){
		return [
			'id' => $review->id,
			'appointment_id' => $review->appointment_id,
			'description' => $review->description
		];
	}
}