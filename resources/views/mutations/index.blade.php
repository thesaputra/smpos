@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-lg-12">
    <h2 class="page-header">Data Mutasi Kirim
      <small>list</small>
    </h2>
    <div class="text-right">
			<div class="form-group">
				<a class="btn btn-primary" href="{!! route('transaction.mutation.create') !!}" role="button">+ Mutasi Baru</a>
			</div>
		</div>
    <table class="table table-striped table-bordered table-hover" id="datas-table">
      <thead>
        <tr class="bg-info">
          <th>No</th>
          <th>No Mutasi</th>
          <th>Tanggal Mutasi</th>
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
        ajax: '{!! route('mutation.mutation_data') !!}',
        columns: [
            { data: 'rownum', name: 'rownum',searchable: false},
            { data: 'no_mutasi', name: 'no_mutasi' },
            { data: 'date_mutation', name: 'date_mutation' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
});
</script>

@endpush
