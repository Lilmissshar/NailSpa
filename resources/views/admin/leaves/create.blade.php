@extends('layouts.admin.master')

@section('content')
	<div class="container">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-12 d-flex">
            <h4 class="text-center mr-auto my-1">Add a new leave</h4>
          </div>
        </div>
      </div>
      <div class="card-body">
        {!! Form::open(['route' => 'admin.leaves.store', 'class' => 'form', 'id' => 'form-validation']) !!}
        <div class="form-group has-label">
          <label>Staff Email
            <star class="star">*</star>
          </label>
          {{ Form::select('staff_id', $staffs, null, [ 'class' => 'form-control', 'required']) }}
        </div>
        <div class="form-group has-label">
          <label>Reason
            <star class="star">*</star>
          </label>
          {{ Form::select('reason', array('MC' => 'Medical Certificate', 'AL' => 'Applied Leave', 'EL' => 'Emergency Leave'), null, ['class' => 'form-control', 'required']) }}
        </div>
        <div class="form-group has-label">
          <label>Start Date
            <star class="star">*</star>
          </label>
          {{ Form::Date('start_date', null, ['class' => 'form-control', 'required']) }}
        </div>
        <div class="form-group has-label">
          <label>End Date
            <star class="star">*</star>
          </label>
          {{ Form::Date('end_date', null, ['class' => 'form-control', 'required']) }}
        </div>
        <div class="card-category form-category">
          <star class="star">*</star> Required fields
				</div>

        <div class="card-footer text-right">
          <button type="submit" class="btn btn-info btn-fill btn-wd">Submit</button>
        </div>

        {!! Form::close() !!}
      </div>
    </div>
  </div>
@endsection
