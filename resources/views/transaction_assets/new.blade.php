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
<script>
$(document).ready(function() {

  autocomplete_asset_category();

});

function autocomplete_asset_category(){
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
  $("#code-asset").typeahead({
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
        url: '{!! route("transaction.transnew_autocomplete") !!}',
        type: 'GET',
        data: {"term": query},
        dataType: 'json',
        success: function (json) {
          var _tmp_arr = [];
          json.map(function(item){
            _tmp_arr.push(item.code)
            arr1.push({id: item.id, st: item.code})
          })
          return processAsync(_tmp_arr);
        }
      });
    }
  })
  // $("#item").on('typeahead:selected', function (e, code) {
  //   arr1.map(function(i){
  //     if (i.st == code){
  //       $("#item_id").val(i.id);
  //     }
  //   })
  //
  //   if(e.keyCode==13){
  //     arr1.map(function(i){
  //       if (i.st == code){
  //         $("#item_id").val(i.id);
  //       }
  //     })
  //   }
  // })
}
</script>
@stop
