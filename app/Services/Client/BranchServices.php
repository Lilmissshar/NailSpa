<?php

namespace App\Services\Client;

use App\Branch;
use Illuminate\Http\Request;
use App\Services\TransformerService;

class BranchServices extends TransformerService{

	public function all(Request $request){
		// $sort = $request->sort ? $request->sort : 'created_at'; //last parameter is the default
	 //    $order = $request->order ? $request->order : 'desc';
	 //    $limit = $request->limit ? $request->limit : 10;
	 //    $offset = $request->offset ? $request->offset : 0;
	 //    $query = $request->search ? $request->search : '';

	 //    $branch = Branch::where('name', 'like', "%{$query}%")->orderBy($sort, $order);
	    // $listCount = $branch->count();

	    // $branch = $branch->limit($limit)->offset($offset)->get();

	    // return respond(['rows' => $branch, 'total' => $listCount]);

	    return respond($branch);
	}

	public function transform($branch){
		return [
			'name' => $branch->name,
			'location' => $branch->location
		];
	}
}
