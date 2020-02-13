<?php

namespace App\Http\Controllers\Admin;

use App\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\ServiceServices;

class ServicesController extends Controller{

	protected $path = 'admin.services.';
	protected $serviceServices;

	public function __construct(ServiceServices $serviceServices){
		$this->serviceServices = $serviceServices;
	}

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request){
		if ($request->wantsJson()) {
			return $this->serviceServices->all($request);
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
			"type" => "required",
      "description" => "required",
      "time_taken" => "required",
      "branch_id" => "required",
      "price" => "required"
		]);

		$service = new Service();
		$service->type = $request->type;
		$service->description = $request->description;
    $service->time_taken = $request->time_taken;
    $service->branch_id = $request->branch_id;
    $service->price = $request->price;
		$service->save();
		return redirect()->route('admin.services.index');
  }

   public function edit(Service $service){
    return view($this->path . 'edit', ['service' => $service]); //'branch' -> variable from the blade, $branch -> define what the variable is the name that is being transferred
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Museum  $museum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service) {
    return $this->serviceServices->update($request, $service);
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
  public function destroy(Service $service){
    $service->delete();

		return success();
  }
}
