<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute">
  <div class="container">
    <div class="navbar-wrapper">
      <a class="navbar-brand" href="{{ route('staff.login.show') }}" style="color: #dfdfdf">
				{{-- You Can change this to the logo of the project --}}
				The Techy Hub
      </a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-bar burger-lines"></span>
        <span class="navbar-toggler-bar burger-lines"></span>
        <span class="navbar-toggler-bar burger-lines"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse justify-content-end" id="navbar">
      <ul class="navbar-nav">
        <!--  admin_register_open() --> 
        {{--<li class="nav-item ">
	        <a href="{{ route('staff.register.show') }}" class="nav-link">
	          <i class="nc-icon nc-badge"></i> Register
	        </a>
        </li>--}}
        
        <li class="nav-item">
          <a href="{{ route('staff.login.show') }}" class="nav-link">
						<i class="nc-icon nc-mobile"></i> Login
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
