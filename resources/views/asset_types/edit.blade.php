@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-3">
    </div>
  <div class="col-md-6">
    <h2 class="page-header">Edit Data Tipe Asset
    </h2>
    {!! Form::model($asset_type,['method' => 'PATCH','route'=>['master.asset_type.update',$asset_type->id]]) !!}
        <div class="form-group">
            {!! Form::label('code', 'Kode Asset:') !!}
            {!! Form::text('code',null,['class'=>'form-control', 'readonly'=>'true']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('name', 'Nama Asset:') !!}
            {!! Form::text('name',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
        </div>
        {!! Form::close() !!}
  </div>
</div>

@endsection
