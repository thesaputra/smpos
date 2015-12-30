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
        {!! Form::label('nip', 'NIP POS:') !!}
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
        {!! Form::label('off_reg', 'Tipe Kantor:') !!}
        {!! Form::select('off_reg', [
        'off' => 'Pusat',
        'reg' => 'Regional'],
        null, ['class'=>'form-control','id'=>'off-reg']
        ) !!}
      </div>
      <div class="form-group">
        {!! Form::label('office_region_id', 'Pusat/Region:') !!}
        {!! Form::select('office_region_id', $office_region, null, ['class' => 'form-control','id'=>'office_region_id']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('division_kprk_id', 'Divisi/KPRK:') !!}
        {!! Form::select('division_kprk_id', $division_kprk, null, ['class' => 'form-control','id'=>'division_kprk_id']) !!}
      </div>
      {!! Form::submit('Simpan', ['class' => 'btn btn-primary form-control']) !!}
    </div>
  </div>
  {!! Form::close() !!}
</div>
<script>
$(document).ready(function() {

  $('#off-reg').on('change', function() {
    var data = {
      'id': $(this).val()
    };
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': '{!! csrf_token() !!}'
      }
    });

    $.ajax({
      type: "POST",
      url: '{{ route("ajax.off_reg_select") }}',
      data: data,
      dataType: "Json",
      success: function (data) {


        $('#office_region_id').html('');
          $('#division_kprk_id').html('');
        $.each(data, function (index, value) {
          var newOption = $('<option>');
          newOption.attr('value', index).text(value);
          $('#office_region_id').append(newOption);
        })

        data_at = {
          'id': $('#office_region_id :selected').val(),
          'type': $('#off-reg').val()
        };

        $.ajax({
          type: "POST",
          url: '{{ route("ajax.divisi_kprk_select") }}',
          data: data_at,
          dataType: "Json",
          success: function (data) {
            console.log(data);
            $.each(data, function (index, value) {
              var newOption = $('<option>');
              newOption.attr('value', index).text(value);
              $('#division_kprk_id').append(newOption);
            })
          }
        });

      }
    });
  });

  $('#office_region_id').on('change', function() {
    var data = {
      'id': $(this).val(),
      'type': $('#off-reg').val()
    };
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': '{!! csrf_token() !!}'
      }
    });

    $.ajax({
      type: "POST",
      url: '{{ route("ajax.divisi_kprk_select") }}',
      data: data,
      dataType: "Json",
      success: function (data) {
        $('#division_kprk_id').html('');
        $.each(data, function (index, value) {
          var newOption = $('<option>');
          newOption.attr('value', index).text(value);
          $('#division_kprk_id').append(newOption);
        })
      }
    });
  });


});
</script>
@endsection
