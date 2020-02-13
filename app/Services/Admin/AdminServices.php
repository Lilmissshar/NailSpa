<?php

namespace App\Services\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Services\TransformerService;

class AdminServices extends TransformerService{

	public function all(Request $request){
		$sort = $request->sort ? $request->sort : 'created_at'; //last parameter is the default
	    $order = $request->order ? $request->order : 'desc';
	    $limit = $request->limit ? $request->limit : 10;
	    $offset = $request->offset ? $request->offset : 0;
	    $query = $request->search ? $request->search : '';

	    $admin = User::where('name', 'like', "%{$query}%")->where('role', 1)->orderBy($sort, $order);
	    $listCount = $admin->count();

	    $admin = $admin->limit($limit)->offset($offset)->get();

	    return respond(['rows' => $admin, 'total' => $listCount]);
	}

	public function update(Request $request, User $admin) {
    $request->validate([
      'name' => 'required|string|max:15',
      'email' => 'required',
      'role' => 'required'
    ]);
    //dd($request);
    $admin->name = $request->name; //the variable museum is what the user wrote? 
    $admin->email = $request->email;
    $admin->phone = $request->phone;
    $admin->address = $request->address;
    $admin->role = $request->role;
    $admin->is_guest = $request->is_guest;
    $admin->save();

    return redirect()->route('admin.admins.index'); 
  }



	public function transform($admin){
		return [
			'name' => $admin->name,
			'email' => $admin->email,
			'password' => $admin->password,
			'phone' => $admin->phone,
			'address' => $admin->address,
			'guest' => $admin->is_guest,
			'role' => $admin->role 
		];
	}
}
