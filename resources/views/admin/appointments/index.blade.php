@extends('layouts.admin.master')

@section('content')
	<div class="card bootstrap-table">
    <div class="card-body table-full-width">
      <table id="bootstrap-table" class="table" data-url="{{ route('admin.appointments.index') }}">
        <thead>
          <th data-field="id" class="text-center" data-sortable="true">ID</th>
          <th data-field="time">Time</th>
          <th data-field="date">Date</th>
          <th data-field="staff_id">Staff Name</th>
          <th data-field="customer_id">Customer Name</th>
          <th data-field="duration">Duration</th>
          <th data-field="status">Status</th>
          <th data-field="actions" class="td-actions text-right" data-events="operateEvents" data-formatter="operateFormatter">Actions</th>
        </thead>
      </table>
    </div>
  </div>
@endsection

@section('scripts')
  <script type="text/javascript">
    function operateFormatter(value, row, index) {
      return [
				'<a rel="tooltip" title="Remove" class="btn btn-link btn-danger table-action remove" href="javascript:void(0)">',
        '<i class="fa fa-remove"></i>',
        '</a>', 
        '<a rel="tooltip" title="Edit" class="btn btn-link btn-danger table-action edit" href="javascript:void(0)">',
        '<i class="fa fa-edit"></i>',
        '</a>'
      ].join('');
    }
  </script>
@endsection
