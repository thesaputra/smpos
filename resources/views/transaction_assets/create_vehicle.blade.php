@extends('layouts.app')

@section('content')
<div class="row">
  <h3 class="page-header">Tambah Kendaraan</h3>
  {!! Form::open(['route' => 'transaction.store_vehicle']) !!}
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
            {!! Form::label('name', 'Nama Kendaraan:') !!}
            {!! Form::text('name',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('model_vechicle', 'Jenis/Model:') !!}
            {!! Form::text('model_vechicle',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('trans_gol_id', 'Golongan:') !!}
            {!! Form::select('trans_gol_id', $golongan, null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('merk', 'Merk:') !!}
            {!! Form::text('merk',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('type_vechicle', 'Tipe:') !!}
            {!! Form::text('type_vechicle',null,['class'=>'form-control']) !!}
        </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
        {!! Form::label('no_police', 'Nomor Polisi:') !!}
        {!! Form::text('no_police',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('no_rangka', 'Nomor Rangka:') !!}
        {!! Form::text('no_rangka',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('no_machine', 'Nomor Mesin:') !!}
        {!! Form::text('no_machine',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('year_production', 'Tahun Pembuatan:') !!}
        {!! Form::text('year_production',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('silinder', 'Isi Silinder/HP:') !!}
        {!! Form::text('silinder',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('color_kb', 'Warna KB:') !!}
      {!! Form::text('color_kb',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('color_tnkb', 'Warna TNKB:') !!}
      {!! Form::text('color_tnkb',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('bahan_bakar', 'Bahan Bakar:') !!}
      {!! Form::text('bahan_bakar',null,['class'=>'form-control']) !!}
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      {!! Form::label('date_kir', 'Tanggal KIR:') !!}
      {!! Form::text('date_kir',null,['class'=>'form-control','id'=>'date-kir']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('date_tax', 'Tanggal Pajak:') !!}
      {!! Form::text('date_tax',null,['class'=>'form-control','id'=>'date-tax']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('amount', 'Nilai Perolehan:') !!}
      {!! Form::text('amount',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('date_amount', 'Tanggal Perolehan:') !!}
      {!! Form::text('date_amount',null,['class'=>'form-control','id'=>'date-amount']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('doc_bpkb', 'Dokumen BPKB:') !!}
        {!! Form::text('doc_bpkb',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('doc_stnk', 'Dokumen STNK:') !!}
        {!! Form::text('doc_stnk',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('trans_forvehicle_id', 'Peruntukan Kendaraan:') !!}
        {!! Form::select('trans_forvehicle_id', $vehicles, null, ['class' => 'form-control']) !!}
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
  $('#date-kir').datepicker({
    format: "dd/mm/yyyy",
    language: "id"
  });
  $('#date-tax').datepicker({
    format: "dd/mm/yyyy",
    language: "id"
  });
});
</script>
@endsection
