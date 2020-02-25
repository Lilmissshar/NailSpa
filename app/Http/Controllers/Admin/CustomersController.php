<?php

namespace App\Http\Controllers\Admin;

use App\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\CustomerServices;

class CustomersController extends Controller{

	protected $path = 'admin.customers.';
	protected $customerServices;

	public function __construct(CustomerServices $customerServices){
		$this->customerServices = $customerServices;
	}

  public function index(Request $request){
		if ($request->isJson()) {
			return $this->customerServices->all($request);
		}
		return view($this->path . 'index');
  }

  public function edit(Customer $customer){
    return view($this->path . 'edit', ['customer' => $customer]);
  }

  public function update(Request $request, Customer $customer) {
    return $this->customerServices->update($request, $customer);
  }

  public function destroy(Customer $customer){
    $customer->delete();

		return success();
  }
}
