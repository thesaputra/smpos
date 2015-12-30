@extends('layouts.app')

@section('content')
<div class="row">
  <h3 class="page-header">Tambah Barang</h3>
  {!! Form::open(['route' => 'transaction.store_item','files'=>true]) !!}
  <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('index', 'Index:') !!}
            {!! Form::text('indexx','Auto Generate',['class'=>'form-control','readonly'=>'true']) !!}
            {!! Form::hidden('asset_categories_id',$ac_id,['class'=>'form-control']) !!}
            {!! Form::hidden('user_id',Auth::user()->id,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('mdsap', 'MD SAP:') !!}
            {!! Form::text('mdsap',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('nsdp', 'No Surat Dasar Pengadaan:') !!}
            {!! Form::text('nsdp',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('name', 'Nama Barang:') !!}
            {!! Form::text('name',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('trans_gol_id', 'Golongan:') !!}
            {!! Form::select('trans_gol_id', $golongan, null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('merk', 'Merk:') !!}
            {!! Form::text('merk',null,['class'=>'form-control']) !!}
        </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
        {!! Form::label('trans_investors_id', 'Dana Perolehan:') !!}
        {!! Form::select('trans_investors_id', $investors, null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('qty', 'Jumlah Barang:') !!}
        {!! Form::text('qty',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('trans_unit_id', 'Satuan:') !!}
        {!! Form::select('trans_unit_id', $units, null, ['class' => 'form-control']) !!}
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
        {!! Form::label('trans_conditions_id', 'Kondisi:') !!}
        {!! Form::select('trans_conditions_id', $conditions, null, ['class' => 'form-control']) !!}
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
        {!! Form::label('doc_file', 'Import File:') !!}
        {!! Form::file('doc_file',null,['class'=>'form-control']) !!}
    </div>
  </div>
  <div class="col-md-4">
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
