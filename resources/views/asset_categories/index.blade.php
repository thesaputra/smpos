@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-lg-12">
    <h2 class="page-header">Data Kategori Asset
      <small>list</small>
    </h2>
    <div class="text-right">
			<div class="form-group">
				<a class="btn btn-primary" href="{!! route('master.asset_category.create') !!}" role="button">+ Kategori Asset</a>
			</div>
		</div>
    <table class="table table-striped table-bordered table-hover" id="asset-categories-table">
      <thead>
        <tr class="bg-info">
          <th>No</th>
          <th>Kode</th>
          <th>Nama</th>
          <th>Tipe Asset</th>
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
    $('#asset-categories-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('master.get_asset_category') !!}',
        columns: [
            { data: 'rownum', name: 'rownum',searchable: false},
            { data: 'ac_code', name: 'ac_code' },
            { data: 'ac_name', name: 'ac_name' },
            { data: 'at_b', name: 'at_b' },
            { data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
});
</script>

@endpush
