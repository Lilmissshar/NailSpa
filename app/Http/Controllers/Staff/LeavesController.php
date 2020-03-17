<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Staff\LeaveServices;
use Illuminate\Support\Facades\Storage;
use App\Leave;
use App\Staff;

class LeavesController extends Controller{

	protected $path = 'staff.leaves.';
	protected $leaveServices;

	public function __construct(LeaveServices $leaveServices){
		$this->leaveServices = $leaveServices;
	}

	public function index(Request $request){
		if ($request->wantsJson()){
			return $this->leaveServices->index($request);
		}
		return view($this->path . 'index');
	}

	public function create(){
		return view($this->path . 'create');
	}

	public function store(Request $request){
		return $this->leaveServices->store($request);
	}

	public function edit(Leave $leave){
		$staffs = Staff::pluck('email', 'id');
    $slip = $leave->slip;
    $url = Storage::url($slip);
		return view($this->path . 'edit', ['leave' => $leave, 'staffs' => $staffs, 'url' => $url]);
	}

	public function update(Request $request, Leave $leave){
		return $this->leaveServices->update($request, $leave);
	}

}