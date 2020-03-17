@extends('layouts.partials.client.meta')

@section('master')
  <div class="wrapper">
  	@include('layouts.partials.client.notification')
  	@include('layouts.partials.client.nav')
		{{-- place you contnet here --}}
		@yield('content')
  </div>
@endsection
