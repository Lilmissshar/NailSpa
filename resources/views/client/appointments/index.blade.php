@extends('layouts.client.master')

@section('content')
<timepicker-component prop-branch="{{ $branch }}" prop-service="{{ $service }}" prop-staff="{{ $staff }}" prop-appointments="{{ $appointments }}"></timepicker-component>
@endsection('content')