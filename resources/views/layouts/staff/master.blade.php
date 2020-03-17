@extends('layouts.partials.staff.meta')

@section('master')
  <div class="wrapper">
    @include('layouts.partials.staff.sidebar')
    <div class="main-panel">
      <!-- Navbar -->
      @include('layouts.partials.staff.nav')
      <!-- End Navbar -->

      <div class="content">
        <div class="container-fluid">
					@include('layouts.partials.staff.notification')
          <div class="row">
            <div class="col-md-12">
              @yield('content')
            </div>
          </div>
        </div>
      </div>

      <!-- Footer -->
      @include('layouts.partials.staff.footer')
      <!-- End Footer -->
    </div>
  </div>
@endsection