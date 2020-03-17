<?php

namespace App\Services\Admin;

use App\Review;
use App\Customer;
use Illuminate\Http\Request;
use App\Services\TransformerService;

class ReviewServices extends TransformerService{

	public function all(Request $request){
		$sort = $request->sort ? $request->sort : 'created_at'; //last parameter is the default
	    $order = $request->order ? $request->order : 'desc';
	    $limit = $request->limit ? $request->limit : 10;
	    $offset = $request->offset ? $request->offset : 0;
	    $query = $request->search ? $request->search : '';

	    $reviews = Review::where('appointment_id', 'like', "%{$query}%")->orderBy($sort, $order);
	    $listCount = $reviews->count();

	    $reviews = $reviews->limit($limit)->offset($offset)->get();

	    return respond(['rows' => $this->transformCollection($reviews), 'total' => $listCount]);
	}

	public function transform($review){
		return [
			'id' => $review->id,
			'appointment_id' => $review->appointment_id,
			'customer_name' => $review->appointment->customer->name,
			'customer_email' => $review->appointment->customer->email,
			'service' => $review->appointment->service_staff->service->name,
			'staff' => $review->appointment->service_staff->staff->name,
			'description' => $review->description
		];
	}
}
