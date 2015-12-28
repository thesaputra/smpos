@extends('layouts.app')

@section('content')
<div class="row">
  <h3 class="page-header">Edit Data Divisi</h3>
  <div class="col-md-12">
    <table class="table table-bordered">
      <tr>
        <th>Kode Divisi:</th>
        <td>{{$division->code}}</td>
        <th>Nama Divisi:</th>
        <td>{{$division->name}}</td>
      </tr>
      <tr>
        <th>Singkatan:</th>
        <td>{{$division->abbreviation}}</td>
        <th>Tanggal Buka:</th>
        <td>{{$division->date_open}}</td>
      </tr>
    </table>
  </div>
  <h3 class="page-header">&nbsp;</h3>
  <div class="col-md-4">
    {!! Form::model($division,['method' => 'PATCH','route'=>['master.office.division.update',$division->id],'files' => true]) !!}
        <div class="form-group">
            {!! Form::label('code', 'Nomor Dirian:') !!}
            {!! Form::text('code',null,['class'=>'form-control', 'readonly'=>'true']) !!}
            {!! Form::hidden('office_id',null,['class'=>'form-control', 'readonly'=>'true']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('name', 'Nama Divisi:') !!}
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
            {!! Form::label('address', 'Alamat Divisi:') !!}
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
            {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
        </div>
  </div>
  {!! Form::close() !!}
</div>
<script>
$(document).ready(function() {
  date_open = '{{ $division->date_open}}'
  if (date_open != "0000-00-00") {
    date_open = date_open.split('-');
    date = date_open[2];
    month = date_open[1];
    year = date_open[0];
    $('#date-open').val(date+'/'+month+'/'+year);
  } else {
    $('#date-open').val('');
  }

  $('#date-open').datepicker({
    format: "dd/mm/yyyy",
    language: "id"
  });

});
</script>

@endsection
