@extends('layouts.client.master')

@section('content')
<div class="col-md-4 col-sm-6 ml-auto mr-auto">
    {!! Form::open(['route' => 'client.login', 'id' => 'form-validation', 'class' => 'form form__submit']) !!}
      <div class="card card-login card-hidden">
        <div class="card-header">
          <h4 class="header text-center">Login Form</h4>
        </div>
        <div class="card-body ">
          <div class="form-group has-label">
            <label>Email Address
              <star class="star">*</star>
            </label>
            <input class="form-control" name="email" type="text" email="true" required="true" />
          </div>
          <div class="form-group has-label">
            <label>Password
              <star class="star">*</star>
            </label>
            <input class="form-control" name="password" type="password" required="true" />
          </div>
          <div class="card-category form-category">
            <star class="star">*</star> Required fields
          </div>
        </div>
        <div class="registerButton text-center">
          <button type="submit" class="btn btn-wd btn-primary">Login</button>
        </div>
      </div>
    {!! Form::close() !!}
    <a href="{{route('client.register.show')}}">Not a member? Click here to sign up!</a>
  </div>
@endsection
