<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DateTimeController extends Controller{

	protected $path = 'client.datetime.';

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(){
  	return view($this->path . 'index');
  }

  public function show($id){
  	$branch = Branch::where('id', $id)->first();
  	//first is for object
  	//get is for array 
  	return view($this->path . 'show', ['branch' => $branch]);
  }
}

