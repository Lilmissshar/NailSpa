@extends('layouts.client.master')

@section('content')
{{ $date }} <br>
{{ $time }} <br>
{{ $staff }} <br>
{{ $service }} <br> 
{{ $branch }} <br>

<div class="container">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-12 d-flex">
            <h4 class="text-center mr-auto my-1">Customer Information </h4>
          </div>
        </div>
      </div>
      <div class="card-body">
        {!! Form::open(['route' => ['details.store', $branch->id, $service->id, $staff->id], 'class' => 'form', 'id' => 'form-validation']) !!}        
        <div class="form-group has-label">
          <label>Name
            <star class="star">*</star>
          </label>
          {{ Form::text('name', null, [ 'class'=>'form-control', 'required']) }}
        </div>

        <div class="form-group has-label">
          <label>Mobile
          </label>
          {{ Form::text('mobile', null, ['class' => 'form-control']) }}
        </div>

        <div class="form-group has-label">
          <label>Email
            <star class="star">*</star>
          </label>
          {{ Form::text('email', null, ['class' => 'form-control', 'required']) }}
        </div>

        <div class="form-group has-label">
          <label>Password
            <star class="star">*</star>
          </label>
          {{ Form::password('password', null, ['class' => 'form-control', 'required']) }}
        </div>

        <div class="form-group has-label">
          <label>Time
            <star class="star">*</star>
          </label>
          {{ Form::text('time', $time, ['class' => 'form-control', 'required']) }}
        </div>

        <div class="form-group has-label">
          <label>Date
            <star class="star">*</star>
          </label>
          {{ Form::text('date', $date, ['class' => 'form-control', 'required']) }}
        </div>

         <div class="card-footer text-right">
          <a class="btn btn-success" href="{{ url(route('details.signIn', [$branch, $service, $staff]) . '?time=' . $time . '&date=' . $date) }}">Sign In</a>
          <button type="submit" class="btn btn-info btn-fill btn-wd">Submit</button>
        </div> 
        {{!! Form::close() !!}}
      </div>
    </div>
  </div>
@endsection