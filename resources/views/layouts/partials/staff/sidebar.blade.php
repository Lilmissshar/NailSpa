<div class="sidebar" data-image="{{ asset('images/sidebar_bg.jpg') }}">

  <div class="logo">
		<a href="{{ route('staff.dashboard') }}" class="simple-text logo-mini">
      TH
    </a>
    <a href="{{ route('staff.dashboard') }}" class="simple-text logo-normal">
      The Techy Hub
    </a>
  </div>

  <div class="sidebar-wrapper">
    <div class="user">
			<div class="info">
      <div class="photo">
        <img src="{{ avatar_picture_url(current_user()->avatar) }}" >
      </div>
			<a data-toggle="collapse" href="#collapseExample" class="collapsed">
				<span>{{ str_limit(current_user()->name, 20) }}</span>
      </a>
			</div>
    </div>

    <ul class="nav">
      <li class="nav-item {{ is_active('staff.dashboard') }}">
        <a class="nav-link" href="{{ route('staff.dashboard') }}">
          <i class="fa fa-pie-chart text-info"></i>
          <p>Dashboard</p>
        </a>
      </li>
      <li class="nav-item {{ is_active('appointments') }}">
        <a class="nav-link" href="{{ route('staff.appointments.index') }}">
          <i class="fa fa-pie-chart text-info"></i>
          <p>Appointments</p>
        </a>
      </li>
      <li class="nav-item {{ is_active('leaves') }}">
        <a class="nav-link" href="{{ route('staff.leaves.index') }}">
          <i class="fa fa-pie-chart text-info"></i>
          <p>Leaves</p>
        </a>
      </li>
    </ul>
  </div>
</div>
