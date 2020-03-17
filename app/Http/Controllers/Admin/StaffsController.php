<?php

namespace App\Http\Controllers\Admin;

use App\Staff;
use App\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\StaffServices;

class StaffsController extends Controller{

	protected $path = 'admin.staffs.';
	protected $staffServices;

	function __construct(StaffServices $staffServices){
		$this->staffServices = $staffServices;
	}

  public function index(Request $request){
		if ($request->isJson()) {
			 return $this->staffServices->all($request);
		}
		return view($this->path . 'index');
  }

  public function create(){
		return view($this->path . 'create');
  }

  public function store(Request $request){
		return $this->staffServices->store($request);
  }

  public function edit(Staff $staff){
    $services = $staff->services;
    return view($this->path . 'edit', ['staff' => $staff, 'services' => $services]); 
  }
 
  public function update(Request $request, Staff $staff) {
    return $this->staffServices->update($request, $staff);
  }

  public function destroy(Staff $staff){
    $staff->delete();

	  return success();
  }
}
