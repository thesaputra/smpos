@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-lg-12">
    <h3 class="page-header">Manage Assets
      <small>list</small>
    </h3>
    <ul class="nav nav-tabs" role="tablist">
      <li style="font-size:12px">
        <a href="#" role="tab" data-toggle="tab" data-remote="setup/ma_asset_vehicles" class="get_data">
          <icon class="fa fa-home"></icon>Kendaraan
        </a>
      </li>
      <li style="font-size:12px">
        <a href="#" role="tab" data-toggle="tab" data-remote="setup/ma_asset_proplands" class="get_data">
          <i class="fa fa-user"></i>Tanah
        </a>
      </li>
      <li  style="font-size:12px"><a href="#" role="tab" data-toggle="tab" data-remote="setup/ma_asset_propbuildings" class="get_data">
        <i class="fa fa-user"></i>Gedung</a>
      </li>
      <li style="font-size:12px"><a href="#" role="tab" data-toggle="tab" data-remote="setup/ma_asset_items" class="get_data">
        <i class="fa fa-user"></i>Barang</a>
      </li>
    </ul>
<br/>
<table class="table table-striped table-bordered table-hover" id="datas-table">
  <thead>
    <tr class="bg-info">
      <th>No</th>
      <th>Index</th>
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
  $('.get_data').on('click', function (e) {
    var urldata = $(this).data('remote');
    e.preventDefault();
    var url = $(this).data('remote');
    $.ajax({
      url: url,
      type: 'GET',
      dataType: 'json',
      data: {method: '_GET', submit:true}
    }).always(function (data) {
      $('#datas-table').DataTable( {
        "processing": true,
        "serverSide": true,
        "destroy":true,
        "ajax": {
          "url": urldata,
          "type": "GET"
        },
        "columns": [
          { "data": "rownum", "searchable":false },
          { "data": "index" },
          { "data": "name" },
          { "data": "action" }
        ]
      });
    });
  });

});
</script>

@endpush
