@extends('layouts.app')

@section('content')
<div class="row">
  <h2 class="page-header">Update Mutasi Kirim</h2>
  {!! Form::model($mutation,['method' => 'PATCH','route'=>['transaction.mutation.update',$mutation->id]]) !!}
  <div class="col-md-4">
    <div class="form-group">
      {!! Form::label('no_mutasi', ' No Mutasi:') !!}
      {!! Form::text('no_mutasi',null,['class'=>'form-control','readonly'=>'true']) !!}
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
  <div class="col-md-4">
    <div class="form-group">
      {!! Form::label('date_mutation', 'Tanggal Mutasi:') !!}
      {!! Form::text('date_mutation',null,['class'=>'form-control','id'=>'date-mutation']) !!}
      {!! Form::hidden('status','dikirim',['class'=>'form-control']) !!}
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
</div>
<script>
$(document).ready(function() {
  date_open = '{{ $mutation->date_mutation}}'
  if (date_open != "0000-00-00") {
    date_open = date_open.split('-');
    date = date_open[2];
    month = date_open[1];
    year = date_open[0];
    $('#date-mutation').val(date+'/'+month+'/'+year);
  } else {
    $('#date-mutation').val('');
  }

  $('#date-mutation').datepicker({
    format: "dd/mm/yyyy",
    language: "id"
  });

});
</script>
@endsection
