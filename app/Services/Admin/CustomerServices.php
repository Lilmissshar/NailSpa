<?php

namespace App\Services\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Services\TransformerService;

class CustomerServices extends TransformerService{

	public function all(Request $request){
		$sort = $request->sort ? $request->sort : 'created_at'; //last parameter is the default
	    $order = $request->order ? $request->order : 'desc';
	    $limit = $request->limit ? $request->limit : 10;
	    $offset = $request->offset ? $request->offset : 0;
	    $query = $request->search ? $request->search : '';

	    $customer = User::where('name', 'like', "%{$query}%")->where('role', 0)->orderBy($sort, $order);
	    $listCount = $customer->count();

	    $customer = $customer->limit($limit)->offset($offset)->get();

	    return respond(['rows' => $customer, 'total' => $listCount]);
	}

	public function update(Request $request, User $customer) {
    $request->validate([
      'name' => 'required|string|max:15',
      'email' => 'required',
      'role' => 'required',
      'phone' => 'required',
      'address' => 'required'
    ]);
    //dd($request);
    $customer->name = $request->name; //the variable museum is what the user wrote? 
    $customer->email = $request->email;
    $customer->phone = $request->phone;
    $customer->address = $request->address;
    $customer->role = $request->role;
    $customer->is_guest = $request->is_guest;
    $customer->save();

    return redirect()->route('admin.customers.index'); 
  }



	public function transform($customer){
		return [
			'name' => $customer->name,
			'email' => $customer->email,
			'password' => $customer->password,
			'phone' => $customer->phone,
			'address' => $customer->address,
			'guest' => $customer->is_guest,
			'role' => $customer->role 
		];
	}
}
