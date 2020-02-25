@extends('layouts.client.master')

@section('content')
<div class="container">
	<div class="card">
		<div class="card-header">
			<div class="row">
				<div class="col-12 d-flex">
					<h4 class="text-center">Staff</h4>
				</div>
			</div>
    </div>
      <div class="row card-body">
        <div class="col-md-10 col-sm-12 mx-auto">
          <p align='center'>
          <table style="width:100%">
            @foreach($staffs as $staff)
            <tr>
              <th>Staff Name</th>
              <td>{{$staff->name}}</td>
            </tr>
            <tr>
              <th>Staff Description</th>
              <td>{{$staff->description}}</td>
            </tr>
            <tr>
              <th></th>
              <td><a href="{{ route('appointments.index', ['service'=> $service->id, 'staff' => $staff->id])}}">Choose</a></td>
            </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection