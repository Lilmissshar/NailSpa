<?php

namespace App\Http\Controllers\Client;

use App\Staff;
use App\Branch;
use App\Service;
use App\Appointment;
use App\Customer;
use App\Payment;
use App\staffService;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Client\PaymentServices;


class PaymentsController extends Controller {

  protected $path = 'client.payments.';
  protected $paymentServices;

  public function __construct(PaymentServices $paymentServices) {
    $this->paymentServices = $paymentServices;
  }
  
  public function index(Appointment $appointment) { 

    \Stripe\Stripe::setApiKey('sk_test_0yAfMvp28Rdi1YNtt5XGFnEL00DCKO4TMf');

    $test = \Stripe\PaymentIntent::create([
      'amount' => 1000,
      'currency' => 'myr',
      'payment_method_types' => ['card'],
      'receipt_email' => 'jenny.rosen@example.com',
    ]);

    $intent = \Stripe\PaymentIntent::create([
      'amount' => 1099,
      'currency' => 'myr',
    ]);

    return view($this->path . 'index', ['appointment' => $appointment]);
  }

  // public function show($id){
    // $appointment = Appointment::where('id', $id)->first();
    // //first is for object
    // //get is for array 
    // return view($this->path . 'show', ['appointment' => $appointment]);
  // }/
}