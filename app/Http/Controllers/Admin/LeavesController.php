<?php

namespace App\Http\Controllers\Admin;

use App\Staff;
use App\Leave;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\LeaveServices;

class LeavesController extends Controller{

	protected $path = 'admin.leaves.';
	protected $leaveServices;

	function __construct(LeaveServices $leaveServices){
		$this->leaveServices = $leaveServices;
	}

  public function index(Request $request){
		if ($request->isJson()) {
			 return $this->leaveServices->all($request);
		}
		return view($this->path . 'index');
  }

  public function create(){
    $staffs = Staff::pluck('email', 'id');
		return view($this->path . 'create', ['staffs' => $staffs]);
  }

  public function store(Request $request){
		return $this->leaveServices->store($request);
  }

  public function edit(Leave $leave){
    $staffs = Staff::pluck('email', 'id');
   return view($this->path . 'edit', ['leave' => $leave, 'staffs' => $staffs]); 
   }

  public function update(Request $request, Leave $leave) {
    return $this->leaveServices->update($request, $leave);
  }

  public function destroy(Leave $leave){
    $leave->delete();

	  return success();
  }
}
