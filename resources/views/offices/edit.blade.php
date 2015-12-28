@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-3">
    </div>
  <div class="col-md-6">
    <h2 class="page-header">Edit Data Kantor PUsat
    </h2>
    {!! Form::model($office,['method' => 'PATCH','route'=>['master.office.update',$office->id]]) !!}
        <div class="form-group">
            {!! Form::label('code', 'Kode Regional:') !!}
            {!! Form::text('code',null,['class'=>'form-control', 'readonly'=>'true']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('name', 'Nama Regional:') !!}
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
        <div class="form-group">
            {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
        </div>
        {!! Form::close() !!}
  </div>
</div>
<script>
$(document).ready(function() {
  date_open = '{{ $office->date_open}}'
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
