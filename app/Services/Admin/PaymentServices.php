<?php
namespace App\Services\Admin;

use App\Payment;
use Illuminate\Http\Request;
use App\Services\TransformerService;

class PaymentServices extends TransformerService{

	public function all(Request $request){
		$sort = $request->sort ? $request->sort : 'created_at'; //last parameter is the default
	    $order = $request->order ? $request->order : 'desc';
	    $limit = $request->limit ? $request->limit : 10;
	    $offset = $request->offset ? $request->offset : 0;
	    $query = $request->search ? $request->search : '';

	    $payment = Payment::where('method', 'like', "%{$query}%")->orderBy($sort, $order);
	    $listCount = $payment->count();

	    $payment = $payment->limit($limit)->offset($offset)->get();

	    return respond(['rows' => $this->transformCollection($payment), 'total' => $listCount]);
	}

	public function update(Request $request, Payment $payment) {
	    $data = $request->validate([
	      'method' => 'required',
	      'status' => 'required',
	      'date' => 'required',
	      'code' => 'required'
	      
	    ]);

	    $payment->method = $data['method']; //the variable museum is what the user wrote? 
	    $payment->status = $data['status'];
	    $payment->date = $data['date'];
	    $payment->code = $data['code'];
	    $payment->save();

	    return redirect()->route('admin.payments.index'); 
	  }



	public function transform($payment){
		return [
			'id' => $payment->id,
			'method' => $payment->method,
			'status' => $payment->status,
			'date' => $payment->appointment->date,
			'code' => $payment->promo_code->code
		];
	}
}
