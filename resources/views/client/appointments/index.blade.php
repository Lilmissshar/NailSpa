@extends('layouts.client.master')

@section('content')

	<div class="container my-5">
		<h1>Book your appointments now!</h1>
		<timepicker-component prop-service="{{ $service }}" prop-staff="{{ $staff }}" prop-appointments="{{ $appointments }}"></timepicker-component>
	</div>

@endsection('content')