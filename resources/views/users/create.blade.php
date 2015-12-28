@extends('layouts.app')

@section('content')
<div class="row">
  {!! Form::open(['route' => 'master.user.store']) !!}
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <h2 class="page-header">Tambah Data Pegawai
  </h2>
  <div class="col-md-6">
    <div class="form-group">
      {!! Form::label('name', 'Username:') !!}
      {!! Form::text('name',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('email', 'Email:') !!}
      {!! Form::text('email',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('password', 'Password:') !!}
      <input type="password" class="form-control" name="password">
    </div>
    <div class="form-group">
      {!! Form::label('password_confirmation', 'Password Konfirmasi:') !!}
      <input type="password" class="form-control" name="password_confirmation">
    </div>
    <div class="form-group">
      {!! Form::label('role_id', 'Level Petugas:') !!}
      {!! Form::select('role_id', $roles, null, ['class' => 'form-control']) !!}
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <div class="form-group">
        {!! Form::label('nip', 'Kode Pegawai:') !!}
        {!! Form::text('nip',null,['class'=>'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('employee_name', 'Nama Pegawai:') !!}
        {!! Form::text('employee_name',null,['class'=>'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('sex', 'Jenis Kelamin:') !!}
        {!! Form::select('sex', [
        'Laki-laki' => 'Laki-laki',
        'Perempuan' => 'Perempuan'],
        null, ['class'=>'form-control']
        ) !!}
      </div>
      <div class="form-group">
        {!! Form::label('address', 'Alamat:') !!}
        {!! Form::text('address',null,['class'=>'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('phone', 'Telepon:') !!}
        {!! Form::text('phone',null,['class'=>'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('office_id', 'Tempat Bekerja:') !!}
        {!! Form::select('office_id', $offices, null, ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('division', 'Divisi:') !!}
        {!! Form::select('division', $division, null, ['class' => 'form-control']) !!}
      </div>
      {!! Form::submit('Simpan', ['class' => 'btn btn-primary form-control']) !!}
    </div>
  </div>
  {!! Form::close() !!}
</div>
@endsection
