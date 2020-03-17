<?php

namespace App\Http\Controllers\Client;

use App\Review;
use App\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Client\ReviewServices;

class ReviewsController extends Controller{

	protected $path = 'client.reviews.';
	protected $reviewServices;

	public function __construct(ReviewServices $reviewServices) {
		$this->reviewServices = $reviewServices;
	}
	
  public function index(Appointment $appointment){
  	return view($this->path . 'index', ['appointment' => $appointment]);
  }

  public function store(Request $request, Appointment $appointment){
  	return $this->reviewServices->store($request, $appointment);
  }
}

