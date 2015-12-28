@extends('layouts.app')

@section('content')
<div class="row">
  <h2 class="page-header">Tambah Penempatan Baru
  </h2>
  <div class="col-md-6">
    {!! Form::open(['route' => 'transaction.placing.store']) !!}
    <div class="form-group">
      {!! Form::label('no_penempatan', ' No Penempatan:') !!}
      {!! Form::text('no_penempatan',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('office_sender', 'Kantor Asal:') !!}
      {!! Form::text('office_sender',$valid_office,['class'=>'form-control','readonly'=>'true']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('division_sender', 'Divisi Asal:') !!}
      {!! Form::text('division_sender',$valid_division,['class'=>'form-control','readonly'=>'true']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('office_destination', 'Kantor Tujuan:') !!}
      {!! Form::text('office_destination',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('division_destination', 'Divisi Tujuan:') !!}
      {!! Form::text('division_destination',null,['class'=>'form-control']) !!}
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      {!! Form::label('date_penempatan', 'Tanggal Penempatan:') !!}
      {!! Form::text('date_penempatan',null,['class'=>'form-control','id'=>'date-penempatan']) !!}
      {!! Form::hidden('status','berubah',['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('floor', 'Lantai:') !!}
      {!! Form::text('floor',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('room', 'Ruangan:') !!}
      {!! Form::text('room',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('description', 'Keterangan Tambahan:') !!}
      {!! Form::textarea('description',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::submit('Simpan', ['class' => 'btn btn-primary form-control']) !!}
    </div>
    {!! Form::close() !!}
  </div>
</div>
<script>
$(document).ready(function() {
  $('#date-penempatan').datepicker({
    format: "dd/mm/yyyy",
    language: "id"
  });
});
</script>
@endsection
