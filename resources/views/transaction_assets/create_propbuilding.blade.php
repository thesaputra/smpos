@extends('layouts.app')

@section('content')
<div class="row">
  <h3 class="page-header">Tambah Properti {{$tipe}}</h3>
  {!! Form::open(['route' => 'transaction.store_propbuilding','files'=>true]) !!}
  <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('index', 'Index:') !!}
            {!! Form::text('indexx','Auto Generate',['class'=>'form-control','readonly'=>'true']) !!}
            {!! Form::hidden('asset_categories_id',$ac_id,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('mdsap', 'MD SAP:') !!}
            {!! Form::text('mdsap',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('name', 'Nama Gedung:') !!}
            {!! Form::text('name',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('trans_gol_id', 'Golongan:') !!}
            {!! Form::select('trans_gol_id', $golongan, null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('trans_forbuilding_id', 'Peruntukan Gedung:') !!}
            {!! Form::select('trans_forbuilding_id', $forbuildings, null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('index tanah', 'Index Tanah:') !!}
            {!! Form::text('index_tanah',null,['class'=>'form-control']) !!}
        </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
        {!! Form::label('lat', 'Lokasi Gedung (Latitude):') !!}
        {!! Form::text('lat',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('lang', 'Langitude:') !!}
        {!! Form::text('lang',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('building_ha', 'Luas Tanah:') !!}
        {!! Form::text('building_ha',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('trans_investors_id', 'Dana Perolehan:') !!}
        {!! Form::select('trans_investors_id', $investors, null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('amount', 'Nilai Perolehan:') !!}
        {!! Form::text('amount',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('date_amount', 'Tanggal Perolehan:') !!}
        {!! Form::text('date_amount',null,['class'=>'form-control','id'=>'date-amount']) !!}
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
        {!! Form::label('trans_statusbuilding_id', 'Status Gedung:') !!}
        {!! Form::select('trans_statusbuilding_id', $statusbuildings, null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('floors', 'Jumlah lantai:') !!}
        {!! Form::text('floors',null,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('doc_building', 'Dokumen Gedung:') !!}
        {!! Form::file('doc_building',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('description', 'Keterangan Tambahan:') !!}
        {!! Form::textarea('description',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Simpan', ['class' => 'btn btn-primary form-control']) !!}
    </div>
  </div>
    {!! Form::close() !!}
</div>
<script>
$(document).ready(function() {
  $('#date-amount').datepicker({
    format: "dd/mm/yyyy",
    language: "id"
  });
});
</script>
@endsection
