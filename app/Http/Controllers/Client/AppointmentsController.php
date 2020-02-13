<?php

namespace App\Http\Controllers\Client;

use App\Branch;
use App\Appointment;
use App\Staff;
use App\Service;
use App\StaffService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppointmentsController extends Controller{

	protected $path = 'client.appointments.';
	
  public function index(Request $request, Branch $branch, Service $service, Staff $staff){
    $date = $request->date ? $request->date : Carbon::now()->format('d/m/Y');
    $staffService = StaffService::where('staff_id', $staff->id)->where('service_id', $service->id)->first();
    //show the appointments that match the services and staffs 
    $appointments = Appointment::where('branch_id', $branch->id)->where('staff_service_id', $staffService->id)->where('date', $date)->get(); //this query is to get the appoinments that has already been set in the database, so that they can detect which timeslot/date to block so another person cannot pick it again. 
    if($request->wantsJson()) {
      return response($appointments, 200);
    }
    
  	return view($this->path . 'index', ['branch' => $branch, 'staff' => $staff, 'service' => $service, 'appointments' => $appointments]);
  }
}

