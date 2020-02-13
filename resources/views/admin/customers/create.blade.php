@extends('layouts.admin.master')

@section('content')
	<div class="container">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-12 d-flex">
            <h4 class="text-center mr-auto my-1">Add a new customer</h4>
          </div>
        </div>
      </div>
      <div class="card-body">
        {!! Form::open(['route' => 'admin.customers.store', 'class' => 'form', 'id' => 'form-validation']) !!}
        <div class="form-group has-label">
          <label>Name
            <star class="star">*</star>
          </label>
          {{ Form::text('name', null, [ 'class'=>'form-control', 'required']) }}
        </div>
        <div class="form-group has-label">
          <label>Email
            <star class="star">*</star>
          </label>
          {{ Form::text('email', null, ['class' => 'form-control', 'required']) }}
        </div>
        <div class="form-group has-label">
          <label>Phone
          </label>
          {{ Form::text('phone', null, ['class' => 'form-control']) }}
        </div>
        <div class="form-group has-label">
          <label>Address
          </label>
          {{ Form::text('address', null, ['class' => 'form-control']) }}
        </div>
        <div class="form-group has-label">
          <label>Guest
          </label>
          {{ Form::text('is_guest', null, ['class' => 'form-control']) }}
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
