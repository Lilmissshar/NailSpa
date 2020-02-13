<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\AdminServices;

class AdminsController extends Controller{

	protected $path = 'admin.admins.';
	protected $adminServices;

	public function __construct(AdminServices $adminServices){
		$this->adminServices = $adminServices;
	}

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request){
		if ($request->isJson()) {
			return $this->adminServices->all($request);
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
		]);

		$admin = new User();
		$admin->name = $request->name;
		$admin->email = $request->email;
    $admin->phone = $request->phone;
    $admin->address = $request->address;
    $admin->is_guest = $request->is_guest;
    $admin->password = "secret";
    $admin->role = 1;
		$admin->save();

		return redirect()->route('admin.admins.index');
  }

   public function edit(User $admin){
    return view($this->path . 'edit', ['admin' => $admin]); //'branch' -> variable from the blade, $branch -> define what the variable is the name that is being transferred
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Museum  $museum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $admin) {
    return $this->adminServices->update($request, $admin);
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
  public function destroy(User $admin){
    $admin->delete();

		return success();
  }
}
