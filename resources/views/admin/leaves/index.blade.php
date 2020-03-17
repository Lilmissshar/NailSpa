@extends('layouts.admin.master')


@section('content')
	<div class="card bootstrap-table">
    <div class="card-body table-full-width">
      <div class="toolbar">
        <a href="{{ route('admin.leaves.create') }}" class="ml-1">
          <button class="btn btn-outline" style="border-radius: 30px">
            <i class="glyphicon fa fa-plus"></i>
          </button>
        </a>
      </div>
      <table id="bootstrap-table" class="table" data-url="{{ route('admin.leaves.index') }}">
        <thead>
          <th data-field="id" class="text-center" data-sortable="true">ID</th>
          <th data-field="staff_id">Staff Name</th>
          <th data-field="reason">Reason</th>
          <th data-field="start_date">Start Date</th>
          <th data-field="end_date">End Date</th>
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
        '<a rel="tooltip" title="Edit" class="btn btn-link btn-danger table-action edit" href="javascript:void(0)">',
        '<i class="fa fa-edit"></i>',
        '</a>'
      ].join('');
    }
  </script>
@endsection
