@extends('layouts.client.master')

@section('content')
<div class="col-md-4 col-sm-6 ml-auto mr-auto">
    {!! Form::model($appointment, ['route' => ['reviews.store', $appointment->id], 'id' => 'form-validation', 'class' => 'form form__submit']) !!}
      <div class="card card-login card-hidden">
        <div class="card-header">
          <h4 class="header text-center">Review Form</h4>
        </div>
        <div class="card-body ">
          <div class="form-group has-label">
            <label>How was your overall experience?
              <star class="star">*</star>
            </label>
            {{ Form::textarea('description', null, ['id' => 'form-validation', 'class' => 'form-control', 'required' => true]) }}
          </div>
          <div class="card-category form-category">
            <star class="star">*</star> Required fields
          </div>
        </div>
        <div class="registerButton text-center">
          <button type="submit" class="btn btn-wd btn-primary">Send</button>
        </div>
      </div>
    {!! Form::close() !!}
  </div>
@endsection
