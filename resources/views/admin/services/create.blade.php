@extends('layouts.admin.master')

@section('content')
	<div class="container">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-12 d-flex">
            <h4 class="text-center mr-auto my-1">Add a new service</h4>
          </div>
        </div>
      </div>
      <div class="card-body">
        {!! Form::open(['route' => 'admin.services.store', 'class' => 'form', 'id' => 'form-validation']) !!}
        <div class="form-group has-label">
          <label>Name
            <star class="star">*</star>
          </label>
          {{ Form::text('name', null, [ 'class'=>'form-control', 'required']) }}
        </div>
        <div class="form-group has-label">
          <label>Description
            <star class="star">*</star>
          </label>
          {{ Form::textarea('description', null, ['class' => 'form-control', 'required']) }}
        </div>
        <div class="form-group has-label">
          <label>Duration
            <star class="star">*</star>
          </label>
          {{ Form::text('duration', null, ['class' => 'form-control', 'required']) }}
        </div>
        <div class="form-group has-label">
          <label>Price
            <star class="star">*</star>
          </label>
          {{ Form::text('price', null, ['class' => 'form-control', 'required']) }}
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
