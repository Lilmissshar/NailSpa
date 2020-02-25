<?php

namespace App\Http\Controllers\Admin;

use App\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\ReviewServices;

class ReviewsController extends Controller{

	protected $path = 'admin.reviews.';
	protected $reviewServices;

	public function __construct(ReviewServices $reviewServices){
		$this->reviewServices = $reviewServices;
	}

  public function index(Request $request){
		if ($request->isJson()) {
			return $this->reviewServices->all($request);
		}
		return view($this->path . 'index');
  }

  public function create(){
		return view($this->path . 'create');
  }

  public function store(Request $request){
    return $this->reviewServices->store($request);
  }

  public function edit(Review $review){
    return view($this->path . 'edit', ['review' => $review]);
  }

  public function update(Request $request, Review $review) {
    return $this->reviewServices->update($request, $review);
  }

  public function destroy(Review $review){
    $review->delete();

		return success();
  }
}
