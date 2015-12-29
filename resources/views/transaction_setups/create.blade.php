@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-3">
    </div>
  <div class="col-md-6">
    <h2 class="page-header">Tambah Data Master Transaksi
    </h2>
        {!! Form::open(['route' => 'transaction.setup.store']) !!}
        <div class="form-group">
          {!! Form::label('type_master', 'Jenis Master:') !!}
          {!! Form::select('type_master', [
          '0' => 'Kondisi',
          '1' => 'Satuan',
          '2' => 'Status Tanah',
          '3' => 'Status Sertifikat',
          '4' => 'Status Bangunan',
          '5' => 'Dana Perolehan',
          '6' => 'Golongan',
          '7' => 'Peruntukan Kendaraan',
          '8' => 'Peruntukan Tanah',
          '9' => 'Peruntukan Bangunan',
          '10' => 'Status Barang'
          ],
          null, ['class'=>'form-control']
          ) !!}
        </div>
        <div class="form-group">
            {!! Form::label('name', 'Nama:') !!}
            {!! Form::text('name',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Simpan', ['class' => 'btn btn-primary form-control']) !!}
        </div>
        {!! Form::close() !!}
  </div>
</div>
<script>
$(document).ready(function() {
  $('#date-open').datepicker({
    format: "dd/mm/yyyy",
    language: "id"
  });
});
</script>

@endsection
