<?php

namespace App\Http\Controllers\Admin;

use App\Branch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\BranchServices;

class BranchController extends Controller{

	protected $path = 'admin.branch.';
	protected $branchServices;

	public function __construct(BranchServices $branchServices){
		$this->branchServices = $branchServices;
	}

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request){
		if ($request->isJson()) {
			return $this->branchServices->all($request);
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
      "location" => "required"
		]);

		$branch = new Branch();
		$branch->name = $request->name;
		$branch->location = $request->location;
		$branch->save();

		return redirect()->route('admin.branch.index');
  }

   public function edit(Branch $branch){
    return view($this->path . 'edit', ['branch' => $branch]); //'branch' -> variable from the blade, $branch -> define what the variable is the name that is being transferred
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Museum  $museum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Branch $branch) {
    return $this->branchServices->update($request, $branch);
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
  public function destroy(Branch $branch){
    $branch->delete();

		return success();
  }
}
