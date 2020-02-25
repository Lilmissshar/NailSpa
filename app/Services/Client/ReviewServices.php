<?php

namespace App\Services\Client;

use App\Review;
use App\Appointnemnt;
use Illuminate\Http\Request;
use App\Services\TransformerService;

class ReviewServices extends TransformerService{

	public function store(Request $request){
		$data = $request->validate([
			'appointment_id' => 'required',
			'description' => 'required'
		]);

		$review = new Review();
		$review->appointment_id = $request->appointment_id;
		$review->description = $request->description;
		$review->save();

		return redirect()->route('reviews.index');
	}

	public function transform($review){
		return [
			'id' => $review->id,
			'appointment_id' => $review->appointment_id,
			'description' => $review->description
		];
	}
}