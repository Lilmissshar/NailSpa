<?php

namespace App\Services\Admin;

use App\Review;
use Illuminate\Http\Request;
use App\Services\TransformerService;

class ReviewServices extends TransformerService{

	public function all(Request $request){
		$sort = $request->sort ? $request->sort : 'created_at'; //last parameter is the default
	    $order = $request->order ? $request->order : 'desc';
	    $limit = $request->limit ? $request->limit : 10;
	    $offset = $request->offset ? $request->offset : 0;
	    $query = $request->search ? $request->search : '';

	    $review = Review::where('user_id', 'like', "%{$query}%")->orderBy($sort, $order);
	    $listCount = $review->count();

	    $review = $review->limit($limit)->offset($offset)->get();

	    return respond(['rows' => $review, 'total' => $listCount]);
	}

	public function update(Request $request, Review $review) {
    $data = $request->validate([
      'user_id' => 'required',
      'review' => 'required'
    ]);

    $review->user_id = $data['user_id']; //the variable museum is what the user wrote? 
    $review->review = $data['review'];
    $review->save();

    return redirect()->route('admin.reviews.index'); 
  }



	public function transform($review){
		return [
			'user_id' => $review->user_id,
			'review' => $review->review
		];
	}
}
