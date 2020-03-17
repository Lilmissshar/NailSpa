@extends('layouts.admin.master')


@section('content')
	<div class="card bootstrap-table">
    <div class="card-body table-full-width">
      <table id="bootstrap-table" class="table" data-url="{{ route('admin.reviews.index') }}">
        <thead>
          <th data-field="id" class="text-center" data-sortable="true">ID</th>
          <th data-field="appointment_id">Appointment ID</th>
          <th data-field="customer_name">Customer Name</th>
          <th data-field="customer_email">Customer Email</th>
          <th data-field="service">Service</th>
          <th data-field="staff">Staff</th>
          <th data-field="description">Description</th>
        </thead>
      </table>
    </div>
  </div>
@endsection
