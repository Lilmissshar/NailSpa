<?php

namespace App\Http\Controllers\Admin;

use App\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\PaymentServices;

class PaymentsController extends Controller{

	protected $path = 'admin.payments.';
	protected $paymentServices;

	function __construct(PaymentServices $paymentServices){
		$this->paymentServices = $paymentServices;
	}

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request){
		if ($request->isJson()) {
			 return $this->paymentServices->all($request);
		}
		return view($this->path . 'index');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  // public function create(){
		// return view($this->path . 'create');
  // }

  // /**
  //  * Store a newly created resource in storage.
  //  *
  //  * @param  \Illuminate\Http\Request  $request
  //  * @return \Illuminate\Http\Response
  //  */
  // public function store(Request $request){
		// $this->validate($request, [
		// 	"method" => "required",
  //     "status" => "required",
  //     "date" => "required",
  //     "code" => "required"
		// ]);

		// $payment = new Payment();
		// $payment->method = $request->method;
		// $payment->status = $request->status;
  //   $payment->date = $request->date;
  //   $payment->code = $request->code;
		// $payment->save();

		// return redirect()->route('payments.index');
  // }

   public function edit(Payment $payment){
  
    return view($this->path . 'edit', ['payment' => $payment]); //'branch' -> variable from the blade, $branch -> define what the variable is the name that is being transferred
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Museum  $museum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment) {
    return $this->paymentServices->update($request, $payment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Museum  $museum
     * @return \Illuminate\Http\Response
     */

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\User  $teamMember
   * @return \Illuminate\Http\Response
   */
  public function destroy(Payment $payment){
    $payment->delete();

		return success();
  }
}
