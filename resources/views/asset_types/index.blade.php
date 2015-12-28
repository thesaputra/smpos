@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-lg-12">
    <h2 class="page-header">Data Tipe Asset
      <small>list</small>
    </h2>
    <div class="text-right">
			<div class="form-group">
				<a class="btn btn-primary" href="{!! route('master.asset_type.create') !!}" role="button">+ Tipe Asset</a>
			</div>
		</div>
    <table class="table table-striped table-bordered table-hover" id="asset-types-table">
      <thead>
        <tr class="bg-info">
          <th>No</th>
          <th>Kode</th>
          <th>Nama</th>
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
    $('#asset-types-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('master.get_asset_type') !!}',
        columns: [
            { data: 'rownum', name: 'rownum',searchable: false},
            { data: 'code', name: 'code' },
            { data: 'name', name: 'name' },
            { data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
});
</script>

@endpush
