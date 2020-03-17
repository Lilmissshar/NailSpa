<?php

namespace App\Services\Admin;

use App\Customer;
use Illuminate\Http\Request;
use App\Services\TransformerService;

class CustomerServices extends TransformerService{

	public function all(Request $request){
		$sort = $request->sort ? $request->sort : 'created_at'; //last parameter is the default
	    $order = $request->order ? $request->order : 'desc';
	    $limit = $request->limit ? $request->limit : 10;
	    $offset = $request->offset ? $request->offset : 0;
	    $query = $request->search ? $request->search : '';

	    $customers = Customer::where('is_active', 'like', "%{$query}%")->orderBy($sort, $order);
	    $listCount = $customers->count();

	    $customers = $customers->limit($limit)->offset($offset)->get();

	    return respond(['rows' => $this->transformCollection($customers), 'total' => $listCount]);
	}

	public function update(Request $request, Customer $customer) {
	    $customer->is_active = $request->is_active;
	    $customer->save();

	    return redirect()->route('admin.customers.index'); 
    }

	public function transform($customer){
		return [
			'id' => $customer->id,
			'name' => $customer->name,
			'email' => $customer->email,
			'mobile' => $customer->mobile,
			'is_active' => $customer->is_active
		];
	}
}
