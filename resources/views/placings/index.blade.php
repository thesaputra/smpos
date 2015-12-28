@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-lg-12">
    <h2 class="page-header">Data Penempatan
      <small>list</small>
    </h2>
    <div class="text-right">
			<div class="form-group">
				<a class="btn btn-primary" href="{!! route('transaction.placing.create') !!}" role="button">+ Penempatan Baru</a>
			</div>
		</div>
    <table class="table table-striped table-bordered table-hover" id="datas-table">
      <thead>
        <tr class="bg-info">
          <th>No</th>
          <th>No Penempatan</th>
          <th>Tanggal Penempatan</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
    </table>
  </div>
</div>
@stop

@push('scripts')
<script>
$(document).ready(function() {
    $('#datas-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('placing.placing_data') !!}',
        columns: [
            { data: 'rownum', name: 'rownum',searchable: false},
            { data: 'no_penempatan', name: 'no_penempatan' },
            { data: 'date_penempatan', name: 'date_penempatan' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
});
</script>

@endpush
