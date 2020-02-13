@extends('layouts.client.master')

@section('content')
<div class="container">
	<div class="card">
		<div class="card-header">
			<div class="row">
				<div class="col-12 d-flex">
					<h4 class="text-center">Branches</h4>
				</div>
			</div>
    </div>
      <div class="row card-body">
        <div class="col-md-10 col-sm-12 mx-auto">
          <p align='center'>
          <table style="width:100%">
            @foreach($branches as $branch)
            <tr>
              <th>Branch</th>
              <td>{{$branch->name}}</td>
            </tr>
            <tr>
              <th>Location</th>
              <td>{{$branch->location}}</td>
            </tr>
            <tr>
              <th></th>
              <td><a href="{{ route('services.index', $branch->id)}}">Choose</a></td>
            </tr>
            @endforeach
          </table>

          <!-- <div class="form-group has-label">
            <label>Name
              <label class="star">*</label>
            </label>
            @foreach($branches as $branch)
            {{ Form::text('name', $branch->name, ['id' => 'form-validation', 'class' => 'form-control', 'required' => 'true' ]) }}
            @endforeach
          </div> -->
        </div>
      </div>
    </div>
  </div>
</div>
@endsection