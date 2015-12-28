@extends('layouts.app')

@section('content')
<div class="row">
  <h3 class="page-header">Bagian <small>Data Divisi - Bagian</small></h3>
  <div class="col-md-12">
    <table class="table table-bordered">
      <tr>
        <th>Kode Divisi:</th>
        <td>{{$data_depart['division']->code}}</td>
        <th>Nama Divisi:</th>
        <td>{{$data_depart['division']->name}}</td>
      </tr>
      <tr>
        <th>Singkatan:</th>
        <td>{{$data_depart['division']->abbreviation}}</td>
        <th>Tanggal Buka:</th>
        <td>{{$data_depart['division']->date_open}}</td>
      </tr>
    </table>
  </div>

  <ul class="nav nav-tabs" role="tablist">
    <li>
      <a href="#add-data" role="tab" data-toggle="tab">
        <icon class="fa fa-home"></icon> Tambah Data Bagian
      </a>
    </li>
    <li  class="active"><a href="#lookup-data" role="tab" data-toggle="tab">
      <i class="fa fa-user"></i> List Data Bagian
    </a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane" id="add-data">
    <div class="col-md-12">
      <h4 class="page-header">Tambah Data Bagian</h4>
    </div>
    {!! Form::open(['route' => 'master.office.store_depart','files'=>true]) !!}

    <div class="col-md-4">
      <div class="form-group">
        {!! Form::label('code', 'Nomor Dirian:') !!}
        {!! Form::text('code',null,['class'=>'form-control']) !!}
        {!! Form::hidden('office_division_id',$data_depart['division']->id,['class'=>'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('name', 'Nama Bagian:') !!}
        {!! Form::text('name',null,['class'=>'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('abbreviation', 'Singkatan:') !!}
        {!! Form::text('abbreviation',null,['class'=>'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('date_open', 'Tanggal Buka:') !!}
        {!! Form::text('date_open',null,['id'=>'date-open','class'=>'form-control']) !!}
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        {!! Form::label('address', 'Alamat Bagian:') !!}
        {!! Form::text('address',null,['class'=>'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('phone', 'Telepon:') !!}
        {!! Form::text('phone',null,['class'=>'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('url_photo', 'Foto Pendukung:') !!}
        {!! Form::file('url_photo', null,['class'=>'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('fax', 'No Faks:') !!}
        {!! Form::text('fax',null,['class'=>'form-control']) !!}
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        {!! Form::label('provinsi', 'Provinsi:') !!}
        {!! Form::text('prov',null,['class'=>'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('kota', 'Kota/Kabupaten:') !!}
        {!! Form::text('kota',null,['class'=>'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('kecamatan', 'Kecamatan:') !!}
        {!! Form::text('kecamantan',null,['class'=>'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('kelurahan', 'Kelurahan:') !!}
        {!! Form::text('kelurahan',null,['class'=>'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('lat', 'Latitude:') !!}
        {!! Form::text('lat',null,['class'=>'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('lang', 'Langtitude:') !!}
        {!! Form::text('lang',null,['class'=>'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::submit('Simpan', ['class' => 'btn btn-primary form-control']) !!}
      </div>
    </div>
    {!! Form::close() !!}

  </div>
  <div class="tab-pane fade active in" id="lookup-data">
    <div class="col-md-12">
      <h4 class="page-header">List Data Bagian</h4>

      <table class="table table-striped table-bordered table-hover" id="bagian-table">
        <thead>
          <tr class="bg-info">
            <th>No</th>
            <th>Kode Bagian</th>
            <th>Nama Bagian</th>
            <th>Singkatan Bagian</th>
            <th>Tanggal Buka Bagian</th>
            <th>Aksi</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>


</div>


<script>
$(document).ready(function() {
  $('#bagian-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: '{!! route('master.get_depart_data') !!}',
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
<script>
$(document).ready(function() {
  console.log('{!! csrf_token() !!}')
  $('#date-open').datepicker({
    format: "dd/mm/yyyy",
    language: "id"
  });

  $('#bagian-table').on('click', '#btn-delete[data-remote]', function (e) {
    e.preventDefault();
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': '{!! csrf_token() !!}'
        }
      });
      var url = $(this).data('remote');
      if (confirm('Anda yakin?')) {
        $.ajax({
          url: url,
          type: 'DELETE',
          dataType: 'json',
          data: {method: '_DELETE', submit: true}
        }).always(function (data) {
          $('#bagian-table').DataTable().draw(false);
        });
      }
    });

  // autocomplete_item();
  //
  // $('#item').focus();
});

function autocomplete_item(){
  var substringMatcher = function(strs) {
    return function findMatches(q, cb) {
      var matches, substringRegex;
      matches = [];
      substrRegex = new RegExp(q, 'i');
      $.each(strs, function(i, str) {
        if (substrRegex.test(str)) {
          matches.push(str);
        }
      });
      cb(matches);
    };
  };

  var arr1 = [];
  $("#item").typeahead({
    hint: false,
    highlight: true,
    minLength: 2

  },
  {
    limit: 50,
    async: true,
    templates: {notFound:"Data not found"},
    source: function (query, processSync, processAsync) {
      return $.ajax({
        url: '',
        type: 'GET',
        data: {"term": query},
        dataType: 'json',
        success: function (json) {
          var _tmp_arr = [];
          json.map(function(item){
            _tmp_arr.push(item.name)
            arr1.push({id: item.id, st: item.name})
          })
          return processAsync(_tmp_arr);
        }
      });
    }
  })
  $("#item").on('typeahead:selected', function (e, code) {
    arr1.map(function(i){
      if (i.st == code){
        $("#item_id").val(i.id);
      }
    })

    if(e.keyCode==13){
      arr1.map(function(i){
        if (i.st == code){
          $("#item_id").val(i.id);
        }
      })
    }
  })
}
</script>

@endsection
