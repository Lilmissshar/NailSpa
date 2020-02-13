@extends('layouts.client.master')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 mx-auto">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-12 d-flex">
							<h4 class="text-center">Location</h4>
						</div>
					</div>
        </div>
          <div class="row card-body">
            <div class="col-md-10 col-sm-12 mx-auto">
              <div class="form-group has-label">
                <p>You have chosen
                {{$branch->name}} at {{$branch->location}}</p>
                <a href="{{ route('services.index', $branch->id) }}">Choose your service</a></td>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection