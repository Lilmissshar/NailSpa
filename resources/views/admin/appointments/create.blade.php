@extends('layouts.admin.master')

@section('content')
	<div class="container">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-12 d-flex">
            <h4 class="text-center mr-auto my-1">Create a new appointment </h4>
          </div>
        </div>
      </div>
      <div class="card-body">
        {!! Form::open(['route' => 'admin.appointments.store', 'class' => 'form', 'id' => 'form-validation']) !!}
        <div class="form-group has-label">
          <label>Time
            <star class="star">*</star>
          </label>
          {{ Form::text('time', null, [ 'class'=>'form-control', 'required']) }}
        </div>
        <div class="form-group has-label">
          <label>Date
            <star class="star">*</star>
          </label>
          {{ Form::text('date', null, ['class' => 'form-control', 'required']) }}
        </div>
        <div class="form-group has-label">
        <label>Staff Service ID
            <star class="star">*</star>
          </label>
          {{ Form::text('staff_service_id', null, ['class' => 'form-control', 'required']) }}
        </div>
        <div class="form-group has-label">
        <label>Branch ID
            <star class="star">*</star>
          </label>
          {{ Form::text('branch_id', null, ['class' => 'form-control', 'required']) }}
        </div>
        <div class="form-group has-label">
        <label>User ID
            <star class="star">*</star>
          </label>
          {{ Form::text('user_id', null, ['class' => 'form-control', 'required']) }}
        </div>
        <div class="form-group has-label">
        <label>Code
            <star class="star">*</star>
          </label>
          {{ Form::text('code', null, ['class' => 'form-control', 'required']) }}
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
