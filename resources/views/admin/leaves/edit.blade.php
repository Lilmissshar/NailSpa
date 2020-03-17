@extends('layouts.admin.master')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 mx-auto">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-12 d-flex">
              <h4 class="text-center">Edit Leaves</h4>
            </div>
          </div>
        </div>

        <div class="row card-body">
          <div class="col-md-10 col-sm-12 mx-auto">
            {!! Form::model($leave, ['route' => ['admin.leaves.update', $leave->id], 'method' => 'PUT', 'id' => 'FormValidation', 'enctype' => 'multipart/form-data']) !!}
              <div class="form-group has-label">
                <label>Staff ID
                  <label class="star">*</label>
                </label>
                {{ Form::select('staff_id', $staffs, null, [ 'class' => 'form-control', 'required' => 'true', 'disabled' => 'true']) }}
              </div>
              <div class="form-group has-label">
                <label>Reason
                  <label class="star">*</label>
                </label>
                {{ Form::select('reason', array('MC' => 'Medical Certificate', 'AL' => 'Applied Leave', 'EL' => 'Emergency Leave'), null, ['id' => 'form-validation', 'class' => 'form-control', 'required' => 'true', 'disabled' => 'true']) }}
              </div>
              <div class="form-group has-label">
                <label>Start Date
                  <label class="star">*</label>
                </label>
                {{ Form::date('start_date', null, ['id' => 'form-validation', 'class' => 'form-control', 'required' => 'true', 'disabled' => 'true']) }}
              </div>
              <div class="form-group has-label">
                <label>End Date
                  <label class="star">*</label>
                </label>
                {{ Form::date('end_date', null, ['id' => 'form-validation', 'class' => 'form-control', 'required' => 'true', 'disabled' => 'true']) }}
              </div>
              <div class="form-group has-label">
                <label>Status
                  <label class="star">*</label>
                </label>
                {{ Form::select('status', array('1' => 'Accepted', '2' => 'Rejected', '3' => 'Pending'), null, ['id' => 'form-validation', 'class' => 'form-control', 'required' => 'true']) }}
              </div>

              @if($leave->slip)
              <a href="{{ $url }}" target="_blank" class="btn btn-primary">View Slip</a>
              @else
              {{ "No slip found" }}
              @endif

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

