<?php

namespace App\Http\Controllers\Admin;

use App\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\AppointmentServices;

class AppointmentsController extends Controller{

	protected $path = 'admin.appointments.';
	protected $appointmentServices;

	public function __construct(AppointmentServices $appointmentServices){
		$this->appointmentServices = $appointmentServices;
	}

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request){
		if ($request->isJson()) {
			return $this->appointmentServices->all($request);
		}
		return view($this->path . 'index');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(){
		return view($this->path . 'create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request){
		$this->validate($request, [
			"time" => "required",
      "date" => "required",
      "staff_service_id" => "required",
      "branch_id" => "required",
      "user_id" => "required",
      "code" => "required"
		]);

		$appointment = new Appointment();
		$appointment->time = $request->time;
		$appointment->date = $request->date;
    $appointment->staff_service_id = $request->staff_service_id;
    $appointment->branch_id = $request->branch_id;
    $appointment->user_id = $request->user_id;
    $appointment->code = $request->code;
		$appointment->save();

		return redirect()->route('admin.appointments.index');
  }

   public function edit(Appointment $appointment){
    return view($this->path . 'edit', ['appointment' => $appointment]); //'branch' -> variable from the blade, $branch -> define what the variable is the name that is being transferred
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Museum  $museum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment) {
    return $this->appointmentServices->update($request, $appointment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Museum  $museum
     * @return \Illuminate\Http\Response
     */

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\User  $teamMember
   * @return \Illuminate\Http\Response
   */
  public function destroy(Appointment $appointment){
    $appointment->delete();

		return success();
  }
}
