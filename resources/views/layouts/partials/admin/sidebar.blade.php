<div class="sidebar" data-image="{{ asset('images/sidebar_1.jpg') }}">

  <div class="logo">
		<a href="{{ route('dashboard') }}" class="simple-text logo-mini">
      TH
    </a>
    <a href="{{ route('dashboard') }}" class="simple-text logo-normal">
      The Techy Hub
    </a>
  </div>

  <div class="sidebar-wrapper">
    <div class="user">
			<div class="info">
      <div class="photo">
        {{--<img src="{{ avatar_picture_url(current_user()->avatar) }}" >--}}
      </div>
			<a data-toggle="collapse" href="#collapseExample" class="collapsed">
				<span>{{ str_limit(current_user()->name, 20) }}</span>
      </a>
			</div>
    </div>

    <ul class="nav">
      <li class="nav-item {{ is_active('dashboard') }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
          <i class="fa fa-pie-chart text-info"></i>
          <p>Dashboard</p>
        </a>
      </li>
      <li class="nav-item {{ is_active('appointments') }}">
        <a class="nav-link" href="{{ route('admin.appointments.index') }}">
          <i class="fa fa-users text-info"></i>
          <p>Appointments</p>
        </a>
      </li>
      <li class="nav-item {{ is_active('customers') }}">
        <a class="nav-link" href="{{ route('admin.customers.index') }}">
          <i class="fa fa-users text-info"></i>
          <p>Customers</p>
        </a>
      </li>
      <li class="nav-item {{ is_active('leaves') }}">
        <a class="nav-link" href="{{ route('admin.leaves.index') }}">
          <i class="fa fa-users text-info"></i>
          <p>Leaves</p>
        </a>
      </li>
      <li class="nav-item {{ is_active('reviews') }}">
        <a class="nav-link" href="{{ route('admin.reviews.index') }}">
          <i class="fa fa-users text-info"></i>
          <p>Reviews</p>
        </a>
      </li>
      <li class="nav-item {{ is_active('services') }}">
        <a class="nav-link" href="{{ route('admin.services.index') }}">
          <i class="fa fa-users text-info"></i>
          <p>Services</p>
        </a>
      </li>
      <li class="nav-item {{ is_active('staffs') }}">
        <a class="nav-link" href="{{ route('admin.staffs.index') }}">
          <i class="fa fa-users text-info"></i>
          <p>Staffs</p>
        </a>
      </li>
    </ul>
  </div>
</div>
