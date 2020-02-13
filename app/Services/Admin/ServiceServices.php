<?php
namespace App\Services\Admin;

use App\Service;
use Illuminate\Http\Request;
use App\Services\TransformerService;

class ServiceServices extends TransformerService{

	public function all(Request $request){
		$sort = $request->sort ? $request->sort : 'created_at'; //last parameter is the default
	    $order = $request->order ? $request->order : 'desc';
	    $limit = $request->limit ? $request->limit : 10;
	    $offset = $request->offset ? $request->offset : 0;
	    $query = $request->search ? $request->search :'';

	    $service = Service::where('type', 'like', "%{$query}%")->orderBy($sort, $order);

	    $listCount = $service->count();

	    $service = $service->limit($limit)->offset($offset);
	    
	    $ids = json_decode($request->ids); //jsondecode (from string to array)

	    //the reason we don't send array straight away is because the url cannot read it, if u use string then only it will include the [,] brackets to indicate it as an "array"
	    
	    if($ids > 0) { //count how many array elemets are in .. if(count($ids) > 0)
			$service = $service->whereNotIn('id', $ids); 
			//use the wherenotin to exclude whatever is in that id
	    }

	    $service = $service->get();
	    
	    return respond(['rows' => $service, 'total' => $listCount]);
	}

	public function update(Request $request, Service $service) {
	    $data = $request->validate([
	      'type' => 'required',
	      'description' => 'required',
	      'time_taken' => 'required',
	      'branch_id' => 'required',
	      'price' => 'required'
	      
	    ]);

	    $service->type = $data['type']; //the variable museum is what the user wrote? 
	    $service->description = $data['description'];
	    $service->time_taken = $data['time_taken'];
	    $service->branch_id = $data['branch_id'];
	    $service->price = $data['price'];
	    $service->save();

	    return redirect()->route('admin.services.index'); 
	  }



	public function transform($service){
		return [
			'type' => $service->type,
			'time_taken' => $service->time_taken,
			'description' => $service->description,
			'branch_id' => $service->branch_id,
			'price' => $service->price
		];
	}
}
