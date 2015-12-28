@extends('layouts.app')

@section('content')
<div class="row">
  <h3 class="page-header">Detail Transaksi <small>Petugas Layanan</small></h3>
  <div class="col-md-8">
    <table class="table table-bordered">
      <tr>
        <th>Invoice No:</th>
        <td>{{$data_transaction['transaction']->invoice_number}}</td>
        <th>Tgl & Waktu Selesai:</th>
        <td>{{ date('d/m/Y', strtotime($data_transaction['transaction']->date_deliver)).' at:'.$data_transaction['transaction']->time_deliver}}</td>
      </tr>
      <tr>
        <th>Date Order:</th>
        <td>{{ date('d/m/Y', strtotime($data_transaction['transaction']->date_order))}}</td>
        <th>Petugas Penerima:</th>
        <td>{{$data_transaction['transaction']->username}}</td>
      </tr>
      <tr>
        <th>Nama Pelanggan:</th>
        <td colspan="3">{{$data_transaction['transaction']->name.' / '.$data_transaction['transaction']->phone.' / '.str_limit($data_transaction['transaction']->address, $limit = 20, $end = '...')}}</td>
      </tr>
    </table>
  </div>
  <div>
    <div class="row">
      {!! Form::open(['route' => 'kasir.transaction.store_user','class' =>'form-horizontal']) !!}
      <div class="col-xs-4">
        <div class="col-xs-12">
          {!! Form::text('user',null,['id'=>'user', 'class'=>'form-control','placeholder'=>'Nama Pekerja']) !!}
          {!! Form::hidden('user_id',null,['id'=>'user_id', 'class'=>'form-control','placeholder'=>'']) !!}
          {!! Form::hidden('transaction_id',$data_transaction['transaction']->id,['id'=>'transaction_id', 'class'=>'form-control']) !!}
          {!! Form::text('package',null,['id'=>'package', 'class'=>'form-control','placeholder'=>'Jenis Layanan']) !!}
          {!! Form::hidden('package_id',null,['id'=>'package_id', 'class'=>'form-control','placeholder'=>'']) !!}
          {!! Form::text('start_date',null,['id'=>'start_date', 'class'=>'form-control','placeholder'=>'Tgl Mulai']) !!}
          {!! Form::text('end_date',null,['id'=>'start_date', 'class'=>'form-control','placeholder'=>'Tgl Selesai']) !!}
          {!! Form::text('qty',null,['id'=>'jumlah', 'class'=>'form-control','placeholder'=>'Qty']) !!}

          {!! Form::select('unit', [
          'Kg' => 'Kg',
          'Mtr' => 'Mtr',
          'Pcs' => 'Pcs'],
           null, ['class'=>'form-control']
          ) !!}
          {!! Form::select('status', [
          'Proses' => 'Proses',
          'Done' => 'Done'],
           null, ['class'=>'form-control']
          ) !!}
          <br/>
          <button type="submit" class="btn btn-primary col-xs-12">Tambah</button>
        </div>

      </div>

      {!! Form::close() !!}
    </div>
    <br/>
    <table class="table table-striped table-bordered table-hover">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Petugas</th>
          <th>Layanan</th>
          <th>Qty</th>
          <th>Satuan</th>
          <th>Tgl Pengerjaan</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data_transaction['user_transaction'] as $key=>$data)
        <tr>
          <td>{{ $key+1 }}</td>
          <td>{{ $data->name}}</td>
          <td>{{ $data->package_name}}</td>
          <td>{{ $data->qty}}</td>
          <td>{{ $data->unit }}</td>
          <td>{{ date('d/m/Y H:m', strtotime($data->start_date)).' - '.date('d/m/Y H:m', strtotime($data->end_date))}}</td>
          <td>
            {!! Form::open([
                'method' => 'PATCH',
                'route' => ['kasir.transaction.update_status', $data->trans_user_id]
            ]) !!}
            {!! Form::hidden('status',$data->status,['id'=>'status', 'class'=>'form-control']) !!}
                {!! Form::submit($data->status, ['class' => 'btn btn-default btn-xs']) !!}
            {!! Form::close() !!}
          </td>
          <td>
            {!! Form::open([
                'method' => 'DELETE',
                'route' => ['kasir.transaction.destroy_detail_user', $data->trans_user_id]
            ]) !!}
                {!! Form::submit('Hapus', ['class' => 'btn btn-danger btn-xs']) !!}
            {!! Form::close() !!}
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <div class="col-md-4">
      <a href="{{route('kasir.transaction.detail',$data_transaction['transaction']->id)}}" class="btn btn-info"/>Back</a>
    </div>
  </div>


  <script>
  $(document).ready(function() {
    autocomplete_user();
    autocomplete_package();

    $('#start_date,#end_date').datetimepicker({
        locale: 'id',
        format: "DD/MM/YYYY hh:mm"
    });
    $('#user').focus();
  });

  function autocomplete_user(){
    var substringMatcher = function(strs) {
      return function findMatches(q, cb) {
        var matches, substringRegex;
        matches = [];
        substrRegex = new RegExp(q, 'i');
        $.each(strs, function(i, str) {
          if (substrRegex.test(str)) {
            matches.push(str);
          }
        });
        cb(matches);
      };
    };

    var arr1 = [];
    $("#user").typeahead({
      hint: false,
      highlight: true,
      minLength: 2

    },
    {
      limit: 50,
      async: true,
      templates: {notFound:"Data not found"},
      source: function (query, processSync, processAsync) {
        return $.ajax({
          url: '{!! route("kasir.transaction.user_autocomplete") !!}',
          type: 'GET',
          data: {"term": query},
          dataType: 'json',
          success: function (json) {
            var _tmp_arr = [];
            json.map(function(item){
              _tmp_arr.push(item.name)
              arr1.push({id: item.id, st: item.name})
            })
            return processAsync(_tmp_arr);
          }
        });
      }
    })
    $("#user").on('typeahead:selected', function (e, code) {
      arr1.map(function(i){
        if (i.st == code){
          $("#user_id").val(i.id);
        }
      })

      if(e.keyCode==13){
        arr1.map(function(i){
          if (i.st == code){
            $("#user_id").val(i.id);
          }
          else {
            $("#user").val('');
          }
        })
      }
    })
  }

  function autocomplete_package(){
    var substringMatcher = function(strs) {
      return function findMatches(q, cb) {
        var matches, substringRegex;
        matches = [];
        substrRegex = new RegExp(q, 'i');
        $.each(strs, function(i, str) {
          if (substrRegex.test(str)) {
            matches.push(str);
          }
        });
        cb(matches);
      };
    };

    var arr1 = [];
    $("#package").typeahead({
      hint: false,
      highlight: true,
      minLength: 2

    },
    {
      limit: 50,
      async: true,
      templates: {notFound:"Data not found"},
      source: function (query, processSync, processAsync) {
        return $.ajax({
          url: '{!! route("kasir.transaction.package_autocomplete") !!}',
          type: 'GET',
          data: {"term": query},
          dataType: 'json',
          success: function (json) {
            var _tmp_arr = [];
            json.map(function(item){
              _tmp_arr.push(item.name)
              arr1.push({id: item.id, st: item.name, price_regular: item.price_regular, price_express: item.price_express,satuan: item.unit})
            })
            return processAsync(_tmp_arr);
          }
        });
      }
    })
    $("#package").on('typeahead:selected', function (e, code) {
      arr1.map(function(i){
        if (i.st == code){
          $("#package_id").val(i.id);
          $("#satuan").val(i.satuan);
          if($('#package_type option:selected').val() == 1) {
            $("#harga").val(i.price_regular);
          }
          else {
            $("#harga").val(i.price_express);
          }
        }
      })

      if(e.keyCode==13){
        arr1.map(function(i){
          if (i.st == code){
            $("#package_id").val(i.id);
            $("#satuan").val(i.satuan);
            if($('#package_type option:selected').val() == 1) {
              $("#harga").val(i.price_regular);
            }
            else {
              $("#harga").val(i.price_express);
            }
          }
        })
      }
    })
  }
  </script>

  @endsection
