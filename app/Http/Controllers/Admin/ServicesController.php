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

  public function index(Request $request){
		if ($request->wantsJson()) {
			return $this->serviceServices->all($request);
		}
		return view($this->path . 'index');
  }

  public function create(){
		return view($this->path . 'create');
  }

  public function store(Request $request){
    return $this->serviceServices->store($request);
  }

  public function edit(Service $service){
    return view($this->path . 'edit', ['service' => $service]);
  }

  
  public function update(Request $request, Service $service) {
    return $this->serviceServices->update($request, $service);
  }

  public function destroy(Service $service){
    $service->delete();

		return success();
  }
}
