<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">NailSpa</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      @if(!current_user())
      <li class="nav-item active">
      	<a class="nav-link" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('services.index')}}">Services </a>	      
      </li>
      @else
      <li class="nav-item active">
        <a class="nav-link" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('services.index')}}">Services </a>        
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('appointments.showAppointments')}}">Appointments</a>
      </li>
      @endif
  	</ul>
    <ul class="navbar-nav ml-auto">
  		@if(!current_user())
	      <li class="nav-item">
	        <a class="nav-link" href="{{route('client.login.show')}}">Log In</a>	
	      </li>
	    @else
	      <li class="nav-item">
	      	<a class="nav-link" href="{{route('client.logout')}}">Log Out</a>
	      </li>
	    @endif
    </ul>
  </div>
</nav>