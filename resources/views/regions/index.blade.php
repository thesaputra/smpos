@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-lg-12">
    <h2 class="page-header">Data Regional
      <small>list</small>
    </h2>
    <div class="text-right">
			<div class="form-group">
				<a class="btn btn-primary" href="{!! route('master.region.create') !!}" role="button">+ Regional</a>
			</div>
		</div>
    <table class="table table-striped table-bordered table-hover" id="regions-table">
      <thead>
        <tr class="bg-info">
          <th>No</th>
          <th>Kode Regional</th>
          <th>Nama Regional</th>
          <th>Singkatan</th>
          <th>Tanggal Buka</th>
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
    $('#regions-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('master.get_region') !!}',
        columns: [
            {data: 'rownum', name: 'rownum',searchable: false},
            { data: 'code', name: 'code' },
            { data: 'name', name: 'name' },
            { data: 'abbreviation', name: 'abbreviation' },
            { data: 'date_open', name: 'date_open' },
            { data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
});
</script>

@endpush
