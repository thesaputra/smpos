@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-lg-12">
    <h2 class="page-header">Data Mutasi Terima
      <small>list</small>
    </h2>

    <table class="table table-striped table-bordered table-hover" id="datas-table">
      <thead>
        <tr class="bg-info">
          <th>No</th>
          <th>No Mutasi</th>
          <th>Tanggal Mutasi</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
    </table>
  </div>
</div>
@stop

@push('scripts')
<script>
$(document).ready(function() {
    $('#datas-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('mutation.sent_mutation_data') !!}',
        columns: [
            { data: 'rownum', name: 'rownum',searchable: false},
            { data: 'no_mutasi', name: 'no_mutasi' },
            { data: 'date_mutation', name: 'date_mutation' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
});
</script>

<script>
$(document).ready(function() {

  $('#datas-table').on('click', '#btn-delete[data-remote]', function (e) {
    e.preventDefault();
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': '{!! csrf_token() !!}'
        }
      });
      var url = $(this).data('remote');
      if (confirm('Anda yakin?')) {
        $.ajax({
          url: url,
          type: 'PATCH',
          dataType: 'json',
          data: {method: '_PATCH', submit: true}
        }).always(function (data) {
          $('#datas-table').DataTable().draw(false);
        });
      }
    });
});
</script>

@endpush
