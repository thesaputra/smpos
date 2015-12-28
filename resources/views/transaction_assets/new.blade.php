@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-lg-12">
    <h2 class="page-header">Transaksi Asset
      <small>new transaction</small>
    </h2>
    {!! Form::open(['route' => 'transaction.process']) !!}
    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          {!! Form::label('code_cat_asset', 'Cari Kode Kategori Asset:') !!}
          {!! Form::text('code_cat_asset',null,['id'=>'code-asset','class'=>'form-control','required'=>'true']) !!}
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
@stop
