@extends('layouts.client.master')

@section('content')
<?php
$i = 0;
?>
<div class="container">
	<table class="table">
		<tr>
			<th>Id</th>
			<th>Time</th>
			<th>Date</th>
			<th>Service</th>
			<th>Staff</th>
			<th>Status</th>
			<th>Review</th>
			<th>Actions</th>
		</tr>
		@foreach ($appointments as $appointment)
			<tr>
				<td>{{ $appointments->firstItem() + $i++ }}</td>
				<td>{{ $appointment['time'] }}</td>
				<td>{{ $appointment['date'] }}</td>
				<td>{{ $appointment['service'] }}</td>
				<td>{{ $appointment['staff'] }}</td>
				<td>{{ $appointment['status'] }}</td>
				<td>{{ $appointment['review'] }}</td>
				@if($appointment['review'] != "-")
					<td><a href="{{ route('appointments.edit', $appointment['id']) }}">Edit</a></td>
				@else
					<td><a href="{{ route('reviews.index', ['appointment' => $appointment['id']]) }}">Add a review</td>
				@endif
			</tr> 
		@endforeach
	</table>
	 <div class="d-flex">
    <div class="mx-auto">
			{{ $appointments->links() }}
		</div>
	</div>
</div>
@endsection

