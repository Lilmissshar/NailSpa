<?php
namespace App\Services\Admin;

use App\Staff;
use App\Service;
use App\StaffService;
use Illuminate\Http\Request;
use App\Services\TransformerService;

class StaffServices extends TransformerService{

	public function all(Request $request){
		$sort = $request->sort ? $request->sort : 'created_at'; //last parameter is the default
	    $order = $request->order ? $request->order : 'desc';
	    $limit = $request->limit ? $request->limit : 10;
	    $offset = $request->offset ? $request->offset : 0;
	    $query = $request->search ? $request->search : '';

	    $staffs = Staff::where('name', 'like', "%{$query}%")->orderBy($sort, $order);
	    $listCount = $staffs->count();

	    $staffs = $staffs->limit($limit)->offset($offset)->get();

	    return respond(['rows' => $this->transformCollection($staffs), 'total' => $listCount]);
	}

	public function update(Request $request, Staff $staff) {
	    $data = $request->validate([
	      'name' => 'required',
	      'age' => 'required',
	      'email' => 'required',
	      'phone' => 'required',
	      'description' => 'required',
	      'branch_id' => 'required'
	      
	    ]);

	    $staff->name = $data['name']; //the variable museum is what the user wrote? 
	    $staff->age = $data['age'];
	    $staff->email = $data['email'];
	    $staff->phone = $data['phone'];
	    $staff->description = $data['description'];
	    $staff->branch_id = $data['branch_id'];
	    $staff->save();

	    foreach($request->service_id as $id){
      		$staffService = new StaffService();
      		$staffService->staff_id = $staff->id;
      		$staffService->service_id = $id;
      		$staffService->save();
    	}
    	// dd($request->service_ids)
    	$staff->service()->sync([]);
    	$staff->service()->sync($request->service_id);

	    return redirect()->route('admin.staffs.index'); 
	}

	public function transformService($services) { //services is from $staff->service at transform, parameter can be diff name
		$types = [];

		foreach ($services as $service) {
			array_push($types, $service->type);//push all the service.type into the types array
		}

		return implode(', ', $types);
	}

	public function transform($staff){
		return [
			'id' => $staff->id,
			'name' => $staff->name,
			'age' => $staff->age,
			'email' => $staff->email,
			'phone' => $staff->phone,
			'description' => $staff->description,
			'branch_id' => $staff->branch_id,
			'services' => $this->transformService($staff->service) //use the relationship
		];
	}
}
