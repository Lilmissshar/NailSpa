@extends('layouts.admin.master')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 mx-auto">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-12 d-flex">
              <h4 class="text-center">Edit Appointment</h4>
            </div>
          </div>
        </div>
        <div class="row card-body">
          <div class="col-md-10 col-sm-12 mx-auto">
            {!! Form::model($appointment, ['route' => ['admin.appointments.update', $appointment->id], 'method' => 'PUT', 'id' => 'FormValidation', 'enctype' => 'multipart/form-data']) !!}
              <div class="form-group has-label">
                <label>Time
                  <label class="star">*</label>
                </label>
                {{ Form::text('time', null, ['id' => 'form-validation', 'class' => 'form-control', 'required' => 'true', 'disabled' => 'true']) }}
              </div>
              <div class="form-group has-label">
                <label>Date
                  <label class="star">*</label>
                </label>
                {{ Form::text('date', null, ['id' => 'form-validation', 'class' => 'form-control', 'required' => 'true', 'disabled' => 'true']) }}
              </div>
              <div class="form-group has-label">
                <label>Staff ID
                  <label class="star">*</label>
                </label>
                {{ Form::text('staff_id', null, ['id' => 'form-validation', 'class' => 'form-control', 'required' => 'true', 'disabled' => 'true']) }}
              </div>
              <div class="form-group has-label">
                <label>Customer ID
                  <label class="star">*</label>
                </label>
                {{ Form::text('customer_id', null, ['id' => 'form-validation', 'class' => 'form-control', 'required' => 'true', 'disabled' => 'true']) }}
              </div>
              <div class="form-group has-label">
                <label>Duration
                  <label class="star">*</label>
                </label>
                {{ Form::text('duration', null, ['id' => 'form-validation', 'class' => 'form-control', 'required' => 'true', 'disabled' => 'true']) }}
              </div>
              <div class="form-group has-label">
                <label>Status
                  <label class="star">*</label>
                </label>
                {{ Form::select('status', array('Cancelled' => 'Cancelled', 'Completed' => 'Completed', 'Ongoing' => 'Ongoing'), null, ['id' => 'form-validation', 'class' => 'form-control', 'required' => 'true']) }}
              </div>
              <div class="card-footer ml-auto mr-auto mt-3 text-right">
                <button type="submit" class="btn btn-warning btn-wd">Save Edit</button>
              </div>
            {!! Form::close() !!} 
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection