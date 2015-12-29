@extends('layouts.app')

@section('content')
<div class="row">

  <h3 class="page-header">Setup Data Master Transaksi
    <small>list</small>
  </h3>
  <div class="col-lg-3">
    <ul class="nav nav-pills nav-stacked">
      <li style="font-size:12px">
        <a href="#" role="tab" data-toggle="tab" data-remote="setup/condition" class="get_data">
          <icon class="fa fa-home"></icon>Kondisi
        </a>
      </li>
      <li style="font-size:12px">
        <a href="#" role="tab" data-toggle="tab" data-remote="setup/unit" class="get_data">
          <i class="fa fa-user"></i>Satuan
        </a>
      </li>
      <li  style="font-size:12px"><a href="#" role="tab" data-toggle="tab" data-remote="setup/statusland" class="get_data">
        <i class="fa fa-user"></i>Status Tanah
      </a>
    </li>
    <li style="font-size:12px"><a href="#" role="tab" data-toggle="tab" data-remote="setup/statuscert" class="get_data">
      <i class="fa fa-user"></i>Status Sertifikat
    </a>
  </li>
  <li style="font-size:12px"><a href="#" role="tab" data-toggle="tab" data-remote="setup/statusbuildings" class="get_data">
    <i class="fa fa-user"></i>Status Bangunan
  </a>
</li>
<li style="font-size:12px"><a href="#" role="tab" data-toggle="tab" data-remote="setup/investors" class="get_data">
  <i class="fa fa-user"></i>Dana Perolehan
</a>
</li>
<li style="font-size:12px"><a href="#" role="tab" data-toggle="tab" data-remote="setup/gols" class="get_data">
  <i class="fa fa-user"></i>Golongan
</a>
</li>
<li style="font-size:12px"><a href="#" role="tab" data-toggle="tab" data-remote="setup/forvehicles" class="get_data">
  <i class="fa fa-user"></i>Peruntukan Kendaraan
</a>
</li>
<li style="font-size:12px"><a href="#" role="tab" data-toggle="tab" data-remote="setup/forlands" class="get_data">
  <i class="fa fa-user"></i>Peruntukan Tanah
</a>
</li>
<li style="font-size:12px"><a href="#" role="tab" data-toggle="tab" data-remote="setup/forbuildings" class="get_data">
  <i class="fa fa-user"></i>Peruntukan Bangunan
</a>
</li>
<li style="font-size:12px"><a href="#" role="tab" data-toggle="tab" data-remote="setup/forbuildings" class="get_data">
  <i class="fa fa-user"></i>Status Barang
</a>
</li>
</ul>
</div>

<div class="col-lg-9">
  <div class="text-left">
    <div class="form-group">
      <a class="btn btn-primary" href="{!! route('transaction.setup.create') !!}" role="button">+ Data Master</a>
    </div>
  </div>
  <table class="table table-striped table-bordered table-hover" id="datas-table">
    <thead>
      <tr class="bg-info">
        <th>No</th>
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
          { "data": "name" },
          { "data": "action" }
        ]
      });
    });
  });

});
</script>

@endpush
