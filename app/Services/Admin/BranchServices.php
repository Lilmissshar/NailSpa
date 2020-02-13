<?php

namespace App\Services\Admin;

use App\Branch;
use Illuminate\Http\Request;
use App\Services\TransformerService;

class BranchServices extends TransformerService{

	public function all(Request $request){
		$sort = $request->sort ? $request->sort : 'created_at'; //last parameter is the default
	    $order = $request->order ? $request->order : 'desc';
	    $limit = $request->limit ? $request->limit : 10;
	    $offset = $request->offset ? $request->offset : 0;
	    $query = $request->search ? $request->search : '';

	    $branch = Branch::where('name', 'like', "%{$query}%")->orderBy($sort, $order);
	    $listCount = $branch->count();

	    $branch = $branch->limit($limit)->offset($offset)->get();

	    return respond(['rows' => $branch, 'total' => $listCount]);
	}

	public function update(Request $request, Branch $branch) {
    $data = $request->validate([
      'name' => 'required|string|max:15',
      'location' => 'required'
    ]);

    $branch->name = $data['name']; //the variable museum is what the user wrote? 
    $branch->location = $data['location'];
    $branch->save();

    return redirect()->route('admin.branch.index'); 
  }



	public function transform($branch){
		return [
			'name' => $branch->name,
			'location' => $branch->location
		];
	}
}
