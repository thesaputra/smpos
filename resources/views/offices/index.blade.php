@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-lg-12">
    <h2 class="page-header">Data Kantor Pusat
      <small>list</small>
    </h2>
    <div class="text-right">
			<div class="form-group">
				<a class="btn btn-primary" href="{!! route('master.office.create') !!}" role="button">+ Kantor Pusat</a>
			</div>
		</div>
    <table class="table table-striped table-bordered table-hover" id="offices-table">
      <thead>
        <tr class="bg-info">
          <th>No</th>
          <th>Kode Dirian</th>
          <th>Nama</th>
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
    $('#offices-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('master.get_office') !!}',
        columns: [
            { data: 'rownum', name: 'rownum',searchable: false},
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
