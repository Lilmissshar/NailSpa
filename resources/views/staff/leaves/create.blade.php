@extends('layouts.staff.master')

@section('content')
	<div class="container">
		<div class="card">
			<div class="card-reader">
				<div class="row">
					<div class="col-12 d-flex">
						<h4 class="text-center mr-auto my-1">Request for a leave</h4>
					</div>
				</div>
			</div>
			<div class="card-body">
				{!! Form::open(['route' => 'staff.leaves.store', 'class' => 'form', 'id' => 'form-validation', 'files' => true]) !!}
				<div class="form-group has-label">
					<label>Reason
						<star class="star">*</star>
					</label>
					{{ Form::select('reason', array('MC' => 'Medical Certificate', 'AL' => 'Applied Leave', 'EL' => 'Emergency Leave'), null, ['class' => 'form-control', 'required']) }}
				</div>
				<div class="form-group has-label">
					<label>Start Date
            <star class="star">*</star>
          </label>
          {{ Form::Date('start_date', null, ['class' => 'form-control', 'required']) }}
        </div>
        <div class="form-group has-label">
          <label>End Date
            <star class="star">*</star>
          </label>
          {{ Form::Date('end_date', null, ['class' => 'form-control', 'required']) }}
        </div>
        <div class="form-group has-label">
          <label>Uploads
            <star class="star">*</star>
          </label><br>
          {{ Form::File('image', null, ['class' => 'form-control', 'required']) }}
        </div>
        <div class="card-category form-category">
          <star class="star">*</star> Required fields
				</div>

        <div class="card-footer text-right">
          <button type="submit" class="btn btn-info btn-fill btn-wd">Submit</button>
        </div>

        {!! Form::close() !!}
      </div>
    </div>
  </div>
@endsection