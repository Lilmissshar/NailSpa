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

	public function update(Request $request, Review $review) {
	    $data = $request->validate([
	      'appointment_id' => 'required',
	      'description' => 'required'
	    ]);

	    $review->appointment_id = $data['appointment_id'];
	    $review->description = $data['description'];
	    $review->save();

	    return redirect()->route('admin.reviews.index'); 
  }

    public function store(Request $request){
    	$data = $request->validate([
	      'appointment_id' => 'required',
	      'description' => 'required'
	    ]);

		$review = new Review();
		$review->appointment_id = $request->appointment_id;
		$review->description = $request->description;
		$review->save();

		return redirect()->route('admin.reviews.index');
    }

	public function transform($review){
		return [
			'id' => $review->id,
			'appointment_id' => $review->appointment_id,
			'description' => $review->description
		];
	}
}
