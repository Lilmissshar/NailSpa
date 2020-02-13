@extends('layouts.admin.master')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 mx-auto">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-12 d-flex">
              <h4 class="text-center">Edit User</h4>
            </div>
          </div>
        </div>

        <div class="row card-body">
          <div class="col-md-10 col-sm-12 mx-auto">
            {!! Form::model($customer, ['route' => ['admin.customers.update', $customer->id], 'method' => 'PUT', 'id' => 'FormValidation', 'enctype' => 'multipart/form-data']) !!}
              <div class="form-group has-label">
                <label>Name
                  <label class="star">*</label>
                </label>
                {{ Form::text('name', null, ['id' => 'form-validation', 'class' => 'form-control', 'required' => 'true']) }}
              </div>
              <div class="form-group has-label">
                <label>Email
                  <label class="star">*</label>
                </label>
                {{ Form::text('email', null, ['id' => 'form-validation', 'class' => 'form-control', 'required' => 'true']) }}
              </div>
              <div class="form-group has-label">
                <label>Phone
                  <label class="star">*</label>
                </label>
                {{ Form::text('phone', null, ['id' => 'form-validation', 'class' => 'form-control']) }}
              </div>
              <div class="form-group has-label">
                <label>Address
                  <label class="star">*</label>
                </label>
                {{ Form::text('address', null, ['id' => 'form-validation', 'class' => 'form-control']) }}
              </div>
              <div class="form-group has-label">
                <label>Role
                  <label class="star">*</label>
                </label>
                {{ Form::text('role', null, ['id' => 'form-validation', 'class' => 'form-control', 'required' => 'true']) }}
              </div>
              <div class="form-group has-label">
                <label>Guest
                  <label class="star">*</label>
                </label>
                {{ Form::text('is_guest', null, ['id' => 'form-validation', 'class' => 'form-control']) }}
              </div>
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