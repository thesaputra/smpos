@extends('layouts.app')

@section('content')
<div class="row">
  <h3 class="page-header">Tambah Properti Tanah</h3>
  {!! Form::open(['route' => 'transaction.store_propland']) !!}
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
            {!! Form::label('no_cert', 'No Sertifikat:') !!}
            {!! Form::text('no_cert',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('name', 'Nama Tanah:') !!}
            {!! Form::text('name',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('trans_gol_id', 'Golongan:') !!}
            {!! Form::select('trans_gol_id', $golongan, null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('date_cert', 'Tanggal Sertifikat:') !!}
            {!! Form::text('date_cert',null,['class'=>'form-control','id'=>'date-cert']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('date_expired_cert', 'Tanggal Expired Sertifikat:') !!}
            {!! Form::text('date_expired_cert',null,['class'=>'form-control','id'=>'date-cert-expired']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('trans_statuscert_id', 'Status Sertifikat:') !!}
            {!! Form::select('trans_statuscert_id', $status_sertifikat, null, ['class' => 'form-control']) !!}
        </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
        {!! Form::label('name_owner', 'Nama Pemegang:') !!}
        {!! Form::text('name_owner',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('trans_investors_id', 'Dana Perolehan:') !!}
        {!! Form::select('trans_investors_id', $investors, null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('tran_forland_id', 'Peruntukan Tanah:') !!}
        {!! Form::select('trans_forland_id', $forlands, null, ['class' => 'form-control']) !!}
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
        {!! Form::label('land_ha', 'Luas Tanah:') !!}
        {!! Form::text('land_ha',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('trans_statusland_id', 'Status Tanah:') !!}
        {!! Form::select('trans_statusland_id', $statuslands, null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('lat', 'Lokasi Tanah (Latitude):') !!}
        {!! Form::text('lat',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('lang', 'Langitude:') !!}
        {!! Form::text('lang',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('doc_land', 'Dokumen Tanah:') !!}
        {!! Form::text('doc_land',null,['class'=>'form-control']) !!}
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
  $('#date-cert-expired').datepicker({
    format: "dd/mm/yyyy",
    language: "id"
  });
  $('#date-cert').datepicker({
    format: "dd/mm/yyyy",
    language: "id"
  });
  $('#date-amount').datepicker({
    format: "dd/mm/yyyy",
    language: "id"
  });
});
</script>
@endsection
