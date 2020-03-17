@extends('layouts.client.master')

@section('content')

<div class="customer-details">
  <h3 class="pb-5 pl-2">Booking Details</h3>
  <div class="row">
    <div class="container col-6">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-12 d-flex">
              <h4 class="text-center mr-auto my-1">Customer Information </h4>
            </div>
          </div>
        </div>
        <div class="card-body">
          {!! Form::open(['route' => ['appointments.store', $service->id, $staff->id], 'class' => 'form', 'id' => 'form-validation']) !!}        
          <div class="form-group has-label">
            <label>Name
              <star class="star">*</star>
            </label>
            {{ Form::text('name', current_user()->name, [ 'class'=>'form-control', 'required', 'disabled']) }}
          </div>

          <div class="form-group has-label">
            <label>Mobile
            </label>
            {{ Form::text('mobile', current_user()->mobile, ['class' => 'form-control', 'disabled']) }}
          </div>

          <div class="form-group has-label">
            <label>Email
              <star class="star">*</star>
            </label>
            {{ Form::text('email', current_user()->email, ['class' => 'form-control', 'required', 'disabled']) }}
          </div>

          <div class="form-group has-label">
            <label>Time
              <star class="star">*</star>
            </label>
            {{ Form::text('time', $time, ['class' => 'form-control', 'required', 'disabled']) }}
            {{ Form::hidden('time', $time) }}
          </div>

          <div class="form-group has-label">
            <label>Date
              <star class="star">*</star>
            </label>
            {{ Form::text('date', $date, ['class' => 'form-control', 'required', 'disabled']) }}
            {{ Form::hidden('date', $date) }}
          </div>

           <div class="card-footer text-right">
            <button type="submit" class="btn btn-info btn-fill btn-wd">Confirm Booking</button>
          </div> 
          {!! Form::close() !!}
        </div>
      </div>
    </div>

    <div class="col-6">
      Staff Name: {{ $staff->name }} <br>
      Service Name: {{ $service->name }} <br> 
      Date: {{ $date }} <br>
      Time: {{ $time }} <br>
    </div>
  </div>
</div>
@endsection