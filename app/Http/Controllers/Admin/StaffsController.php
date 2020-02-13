<?php

namespace App\Http\Controllers\Admin;

use App\Staff;
use App\Service;
use App\StaffService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\StaffServices;

class StaffsController extends Controller{

	protected $path = 'admin.staffs.';
	protected $staffServices;

	function __construct(StaffServices $staffServices){
		$this->staffServices = $staffServices;
	}

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request){
		if ($request->isJson()) {
			 return $this->staffServices->all($request);
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
      "age" => "required",
      "email" => "required",
      "phone" => "required",
      "description" => "required",
      "branch_id" => "required"
		]);

		$staff = new Staff();
		$staff->name = $request->name;
		$staff->age = $request->age;
    $staff->email = $request->email;
    $staff->phone = $request->phone;
    $staff->description = $request->description;
    $staff->branch_id = $request->branch_id;
		$staff->save();

    foreach($request->service_id as $id){
      $staffService = new StaffService();
      $staffService->staff_id = $staff->id;
      $staffService->service_id = $id;
      $staffService->save();
    }

		return redirect()->route('admin.staffs.index');
  }

   public function edit(Staff $staff){
    $services = $staff->service;
    return view($this->path . 'edit', ['staff' => $staff, 'services' => $services]); 
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Museum  $museum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Staff $staff) {
    return $this->staffServices->update($request, $staff);
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
  public function destroy(Staff $staff){
    $staff->delete();

		return success();
  }
}
