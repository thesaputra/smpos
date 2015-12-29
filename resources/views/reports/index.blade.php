@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-lg-12">
    <h2 class="page-header">Laporan
      <small>Transaksi - Barang</small>
    </h2>
    {!! Form::open(['route' => 'report.process_item']) !!}
    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          {!! Form::label('date_amount', 'Mulai:') !!}
          {!! Form::text('date_amount',null,['id'=>'date-start','class'=>'form-control','required'=>'true']) !!}
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          {!! Form::label('date_amount', 'Akhir:') !!}
          {!! Form::text('date_amount',null,['id'=>'date-end','class'=>'form-control','required'=>'true']) !!}
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          {!! Form::label('asset_categories_id', 'Asset Kategori:') !!}
          {!! Form::select('asset_categories_id', $asset_category, null, ['class' => 'form-control']) !!}
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          {!! Form::label('user_id', 'Office/Regional:') !!}
          {!! Form::select('user_id', $user_office_regional, null, ['class' => 'form-control']) !!}
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label>&nbsp;</label>
          {!! Form::submit('Proses', ['class' => 'btn btn-success form-control']) !!}
        </div>
      </div>
    {!! Form::close() !!}
  </div>
</div>

<script>
$(document).ready(function() {

  $('#date-start').datepicker({
    format: "dd/mm/yyyy",
    language: "id"
  });
  $('#date-end').datepicker({
    format: "dd/mm/yyyy",
    language: "id"
  });

});
</script>
@stop
