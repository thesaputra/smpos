@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-3">
  </div>
  <div class="col-md-6">
    <h2 class="page-header">Edit Data Kategori Asset
    </h2>
    {!! Form::model($asset_category,['method' => 'PATCH','route'=>['master.asset_category.update',$asset_category->id]]) !!}
    <div class="form-group">
      {!! Form::label('code', 'Kode Kategori:') !!}
      {!! Form::text('code',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('name', 'Nama Kategori:') !!}
      {!! Form::text('name',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('asset_type_id', 'Tipe Asset:') !!}
      {!! Form::select('asset_type_id', $asset_types, null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('description', 'Keterangan:') !!}
      {!! Form::text('description',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
    </div>
    {!! Form::close() !!}
  </div>
</div>

@endsection
