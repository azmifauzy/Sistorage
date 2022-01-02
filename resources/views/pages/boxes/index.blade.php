@extends('master')
@section('content')
<div id="items" class="container">
  <div class="d-grid gap-xl bg-white radius-xl p-sm">
    <div class="card">
      <div class="card-header">
        <div class=" d-flex justify-content-between">
          <h3 class="text-dark">
            Data Box
          </h3>
          <a 
            id="goToAddForm" 
            href="/boxes/create" 
            title="add item"
          >
            <i class="bi bi-plus-circle"></i>
            Tambah Box 
          </a>
        </div>
      </div>
      <div class="card-body">
        @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
          {{ session('success') }}
        </div>
        @endif
        <table id="tableItems" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th class="text-center">Status</th>
              <th class="text-center">Kode</th>
              <th class="text-center">Pengirim</th>
              <th class="text-center">Penerima</th>
              <th class="text-center">Tanggal</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($boxes as $box)
              <tr id="{{ $box->id }}">
                <td class="text-center">
                  @foreach ($statusBox as $status)
                      @if ($status->id == $box->statusBox_id)
                          {{ $status->name }}
                      @endif
                  @endforeach  
                </td>
                <td class="text-center">{{ $box->id }}</td>
                <td>{{ $box->sender }}</td>
                <td>{{ $box->receiver }}</td>
                <td>{{ $box->created_at }}</td>
                <td class="text-center d-flex justify-content-center">
                  <a aria-label="edit" href="/boxes/{{ $box->id }}" class="">
                    <i class="bi bi-pencil-fill"></i>
                  </a>
                  <form action="/boxes/{{ $box->id }}" method="post" id="formDeleteData">
                    @csrf
                    @method('delete')
                    <button type="submit" aria-label="delete" id="btnDeleteData">
                      <i class="bi bi-trash-fill"></i>
                    </button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <td colspan="6"><b>Total Box : {{ count($boxes) }} Box</b></td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
    const btnDeleteData = $('#btnDeleteData');
    $(document).on('click', '#btnDeleteData', function(e) {
      e.preventDefault()
      Swal.fire({
        icon: 'warning',
        title: 'Hapus Box?',
        showCancelButton: true,
        confirmButtonText: 'Hapus',
      }).then((result) => {

        if (result.isConfirmed) {
          $(this).closest('#formDeleteData').submit()
        }
      })
    })
  })
</script>
@endsection

@push('data-table')
  @include('../../partials/data-table')
  <script>
    $(() => $("#tableItems").DataTable());
  </script>
@endpush


