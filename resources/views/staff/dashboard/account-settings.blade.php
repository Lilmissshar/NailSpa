@extends('layouts.staff.master')

@section('content')
	<div class="container">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-12 d-flex">
            <h4 class="text-center mr-auto my-1">Account Settings</h4>
          </div>
        </div>
      </div>
      <div class="card-body">
        {!! Form::model(current_user(), ['route' => ['staff.account.update'], 'enctype' => 'multipart/form-data', 'class' => 'form', 'id' => 'account-settings-form']) !!}
        <div class="form-group has-label">
          <label>Profile Picture
            <star class="star">*</star>
          </label>
          <div class="d-flex">
						<img src="{{ avatar_picture_url(current_user()->avatar) }}" id="avatar-pic" class="border-gray img-thumbnail img-thumbnail-profile"><br>
						<div class="input-group mb-3">
						  <div class="custom-file">
								{{ Form::file('avatar', ['class' =>'custom-file-input on__file__change', 'id' => 'file-picker', 'data-target' => '#avatar-pic'])}}<br>
						    <label class="custom-file-label" for="file-picker">Choose file</label>
						  </div>
						</div>

          </div>
        </div>
        <div class="form-group has-label">
          <label>Name
            <star class="star">*</star>
          </label>
          {{ Form::text('name', current_user()->name, [ 'class'=>'form-control', 'required']) }}
        </div>
        <div class="form-group has-label">
          <label>Email
            <star class="star">*</star>
          </label>
          {{ Form::text('email', current_user()->email, ['class' => 'form-control disabled', 'required', 'disabled']) }}
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

  <div class="container">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-12 d-flex">
            <h4 class="text-center mr-auto my-1">Change Password</h4>
          </div>
        </div>
      </div>
      <div class="card-body">
        {!! Form::open(['route' => ['staff.password.change'], 'method' => 'PUT', 'class' => 'form', 'id' => 'change-password-form']) !!}
        <div class="form-group has-label">
          <label>Current Password
            <star class="star">*</star>
          </label>
          <input class="form-control" name="current_password" type="password" required="true" />
        </div>
        <div class="form-group has-label">
          <label>new password
            <star class="star">*</star>
          </label>
          <input class="form-control" name="password" type="password" required="true" />
        </div>
        <div class="form-group has-label">
          <label>Confirm Password
            <star class="star">*</star>
          </label>
          <input class="form-control" name="password_confirmation" type="password" required="true" />
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
