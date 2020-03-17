@extends('layouts.partials.admin.meta')

@section('master')
  <div class="wrapper">
    @include('layouts.partials.admin.sidebar')
    <div class="main-panel">
      <!-- Navbar -->
      @include('layouts.partials.admin.nav')
      <!-- End Navbar -->

      <div class="content">
        <div class="container-fluid">
					@include('layouts.partials.admin.notification')
          <div class="row">
            <div class="col-md-12">
              @yield('content')
            </div>
          </div>
        </div>
      </div>

      <!-- Footer -->
      @include('layouts.partials.admin.footer')
      <!-- End Footer -->
    </div>
  </div> 
@endsection
