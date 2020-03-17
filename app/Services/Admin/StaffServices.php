<?php
namespace App\Services\Admin;

use App\Staff;
use App\ServiceStaff;
use Illuminate\Http\Request;
use App\Services\TransformerService;
use Illuminate\Support\Facades\Hash;

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

	public function store(Request $request){
		$data = $request->validate([
	      'name' => 'required',
	      'age' => 'required',
	      'email' => 'required|unique:staffs',
	      'mobile' => 'required',
	      'description' => 'required'
		]);

		$staff = new Staff();
		$staff->name = $request->name;
		$staff->age = $request->age;
    $staff->email = $request->email;
    $staff->mobile = $request->mobile;
    $staff->description = $request->description;
    $staff->password = Hash::make('secret');
		$staff->save();

    foreach($request->service_id as $id){
      $serviceStaff = new ServiceStaff();
      $serviceStaff->staff_id = $staff->id;
      $serviceStaff->service_id = $id;
      $serviceStaff->save();
  	}

		return redirect()->route('admin.staffs.index');
	}

	public function update(Request $request, Staff $staff) {
	    $data = $request->validate([
	      'name' => 'required',
	      'age' => 'required',
	      'email' => 'required',
	      'mobile' => 'required',
	      'description' => 'required'
	      
	    ]);

	    $staff->name = $data['name']; //the variable museum is what the user wrote? 
	    $staff->age = $data['age'];
	    $staff->email = $data['email'];
	    $staff->mobile = $data['mobile'];
	    $staff->description = $data['description'];
	    $staff->save();

	    foreach($request->service_id as $id){
    		$serviceStaff = new ServiceStaff();
    		$serviceStaff->staff_id = $staff->id;
    		$serviceStaff->service_id = $id;
    		$serviceStaff->save();
    	}
    	
    	$staff->services()->sync([]);
    	$staff->services()->sync($request->service_id);

	    return redirect()->route('admin.staffs.index'); 
	}

	public function transformService($services) { //services is from $staff->service at transform, parameter can be diff name
		$names = [];

		foreach ($services as $service) {
			array_push($names, $service->name);//push all the service.type into the types array
		}

		return implode(', ', $names);
	}

	public function transform($staff){
		return [
			'id' => $staff->id,
			'name' => $staff->name,
			'age' => $staff->age,
			'email' => $staff->email,
			'mobile' => $staff->mobile,
			'description' => $staff->description,
			'services' => $this->transformService($staff->services) //use the relationship
		];
	}
}
