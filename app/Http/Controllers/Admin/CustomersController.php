<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\CustomerServices;

class CustomersController extends Controller{

	protected $path = 'admin.customers.';
	protected $customerServices;

	public function __construct(CustomerServices $customerServices){
		$this->customerServices = $customerServices;
	}

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request){
		if ($request->isJson()) {
			return $this->customerServices->all($request);
		}
		return view($this->path . 'index');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(){
		return view($this->path . 'create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request){
		$this->validate($request, [
			"name" => "required",
      "email" => "required",
      "phone" => "required",
      "address" => "required",
      "is_guest" => "required",
		]);

		$customer = new User();
		$customer->name = $request->name;
		$customer->email = $request->email;
    $customer->phone = $request->phone;
    $customer->address = $request->address;
    $customer->is_guest = $request->is_guest;
    $customer->password = "secret";
    $customer->role = 0;
		$customer->save();

		return redirect()->route('admin.customers.index');
  }

   public function edit(User $customer){
    return view($this->path . 'edit', ['customer' => $customer]); //'branch' -> variable from the blade, $branch -> define what the variable is the name that is being transferred
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Museum  $museum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $customer) {
    return $this->customerServices->update($request, $customer);
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
  public function destroy(User $customer){
    $customer->delete();

		return success();
  }
}
