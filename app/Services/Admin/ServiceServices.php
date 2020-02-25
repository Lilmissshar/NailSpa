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

	    $services = Service::where('name', 'like', "%{$query}%")->orderBy($sort, $order);

	    $listCount = $services->count();

	    $services = $services->limit($limit)->offset($offset);
	    
	    $ids = json_decode($request->ids); //jsondecode (from string to array)

	    //the reason we don't send array straight away is because the url cannot read it, if u use string then only it will include the [,] brackets to indicate it as an "array"
	    
	    if($ids > 0) { //count how many array elemets are in .. if(count($ids) > 0)
			$services = $services->whereNotIn('id', $ids); 
			//use the wherenotin to exclude whatever is in that id
	    }

	    $services = $services->get();
	    
	    return respond(['rows' => $services, 'total' => $listCount]);
	}

	public function update(Request $request, Service $service) {
	    $data = $request->validate([
	      'name' => 'required|unique:services,name,' . $service->id,
	      'description' => 'required',
	      'duration' => 'required',
	      'price' => 'required'
	      
	    ]);

	    $service->name = $data['name']; //the variable museum is what the user wrote? 
	    $service->description = $data['description'];
	    $service->duration = $data['duration'];
	    $service->price = $data['price'];
	    $service->save();

	    return redirect()->route('admin.services.index'); 
	  }

	public function store(Request $request){
		$data = $request->validate ([
			"name" => "required",
	        "description" => "required",
	        "duration" => "required",
	        "price" => "required"
		  ]);

		$service = new Service();
		$service->name = $request->name;
		$service->description = $request->description;
    	$service->duration = $request->duration;
    	$service->price = $request->price;
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
