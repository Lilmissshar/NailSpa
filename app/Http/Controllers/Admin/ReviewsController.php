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
}
