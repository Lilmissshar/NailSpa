<?php
namespace App\Services\Admin;

use App\Staff;
use App\Leave;
use Illuminate\Http\Request;
use App\Services\TransformerService;

class LeaveServices extends TransformerService{

	public function all(Request $request){
		$sort = $request->sort ? $request->sort : 'created_at'; //last parameter is the default
	    $order = $request->order ? $request->order : 'desc';
	    $limit = $request->limit ? $request->limit : 10;
	    $offset = $request->offset ? $request->offset : 0;
	    $query = $request->search ? $request->search : '';
	    $leaves = Leave::where('start_date', 'like', "%{$query}%")->orderBy($sort, $order);
	    $listCount = $leaves->count();

	    $leaves = $leaves->limit($limit)->offset($offset)->get();

	    return respond(['rows' => $this->transformCollection($leaves), 'total' => $listCount]);
	}

	public function store(Request $request){
		$data = $request->validate([
	      'staff_id' => "required",
	      'reason' => "required"
		]);

		$leave = new Leave();
		$leave->staff_id = $request->staff_id;
		$leave->reason = $request->reason;
		$leave->start_date = $request->start_date;
		$leave->end_date = $request->end_date;
		$leave->save();

		return redirect()->route('admin.leaves.index');
	}

	public function update(Request $request, Leave $leave) {
	  $data = $request->validate([
	      'status' => "required"
		]);

		$leave->status = $data['status'];
		$leave->save();

	  return redirect()->route('admin.leaves.index'); 
	}

	public function status($leave){
		switch($leave->status){
			case "1": 
			return "Accepted";
			break;

			case "2":
			return "Rejected";
			break;
			
			case "3":
			return "Pending";
			break;
		}
	}

	public function transform($leave){
		return [
			'id' => $leave->id,
			'staff_id' => $leave->staff->name,
			'reason' => $leave->reason,
			'start_date' => $leave->start_date,
			'end_date' => $leave->end_date,
			'slip' => $leave->slip,
			'status' => $this->status($leave)
		];
	}
}
