<?php

namespace App\Services\Staff;

use Illuminate\Http\Request;
use App\Services\TransformerService;
use Illuminate\Support\Facades\Storage;
use App\Leave;
use Carbon\Carbon;
use File;

class LeaveServices extends TransformerService{
	public function index(Request $request){

		$sort = $request->sort ? $request->sort : 'created_at';
		$order = $request->order ? $request->order : 'desc';
		$limit = $request->limit ? $request->limit :10;
		$offset = $request->offset ? $request->offset : 0;
		$query = $request->search ? $request->search: '';

		$leaves = Leave::where('start_date' , 'like', "%{$query}%")->orderBy($sort, $order);
		$listCount = $leaves->count();

		$leaves = $leaves->limit($limit)->offset($offset)->get();
		return respond(['rows' => $this->transformCollection($leaves), 'total' => $listCount]);
	}

	public function store(Request $request){
		$data = $request->validate([
			'reason' => 'required',
			'start_date' => 'required',
			'end_date' => 'required'
		]);

		$leave = new Leave();
		$leave->staff_id = current_user()->id;
		$leave->reason = $request->reason;
		$leave->start_date = $request->start_date;
		$leave->end_date = $request->end_date;
		$leave->status = "3";

		if ($request->file('image')){
			$imageName = Carbon::now()->timestamp . '.' . $request->file('image')->getClientOriginalExtension();
			$request->file('image')->move(base_path() . '/storage/app/public/', $imageName);
			$leave->slip = $imageName;
			$leave->save();
		} else {
			$leave->save();
		}

		return redirect()->route('staff.leaves.index');
	}


	public function update(Request $request, Leave $leave){
		$data = $request->validate([
			'staff_id' => "required",
			'reason' => "required",
			'start_date' => "required",
			'end_date' => "required",
			'status' => "required"
		]);

		$leave->staff_id = $data['staff_id'];
		$leave->reason = $data['reason'];
		$leave->start_date = $data['start_date'];
		$leave->end_date = $data['end_date'];
		$leave->status = $data['status'];

    if ($request->file('image')){

    	if ($leave->slip){
				Storage::delete('public/'.$leave->slip);
				$leave->slip = null;
			} 

			$imageName = Carbon::now()->timestamp . '.' . $request->file('image')->getClientOriginalExtension();
			$request->file('image')->move(base_path() . '/storage/app/public/', $imageName);
			$leave->slip = $imageName;
			$leave->save();

		} else {

			$leave->save();
		}

		return redirect()->route('staff.leaves.index');
	}

	public function status($leave){
		switch($leave->status){

			case "1":
			return $leave->status = "Accepted";
			break;

			case "2":
			return $leave->status = "Rejected";
			break;
			case "3":

			return $leave->status = "Pending";
			break;
		}
	}

	public function transform($leave){
		return [
			'id' => $leave->id,
			'reason' => $leave->reason,
			'start_date' => $leave->start_date,
			'end_date' => $leave->end_date,
			'status' => $this->status($leave)
		];
	}
}