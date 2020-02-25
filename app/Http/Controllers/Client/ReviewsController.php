<?php

namespace App\Http\Controllers\Client;

use App\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Client\ReviewServices;

class ReviewsController extends Controller{

	protected $path = 'client.reviews.';
	protected $reviewServices;

	public function __construct(ReviewServices $reviewServices) {
		$this->reviewServices = $reviewServices;
	}
	
  public function index(){
  	return view($this->path . 'index');
  }

  public function store(Request $request){
  	return $this->reviewServices->store($request);
  }
}

