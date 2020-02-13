<?php

namespace App\Http\Controllers\Client;

use App\Branch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Client\BranchServices;

class BranchController extends Controller{

	protected $path = 'client.branch.';
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
		$branches = Branch::all();
  	return view($this->path . 'index', ['branches' => $branches]);
  }

  // public function show($id){
  // 	$branch = Branch::where('id', $id)->first();
  // 	//first is for object
  // 	//get is for array 
  // 	return view($this->path . 'show', ['branch' => $branch]);
  // }
}

