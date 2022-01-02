@extends('master')
@section('content')
<div id="items" class="container">
  <div class="d-grid gap-xl bg-white radius-xl p-sm">
    <div class="card">
      <div class="card-header">
        <div class=" d-flex justify-content-between">
          <h3 class="text-dark">
            Data Barang dalam Gudang
          </h3>
          @if (session('role_id') == 1)
          <a 
            id="goToAddForm" 
            href="/storages/create" 
            title="add item"
          >
            <i class="bi bi-plus-circle"></i>
            Tambah Barang
          </a>
          @endif
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
              <th class="text-center">No</th>
              <th class="text-center">Name</th>
              <th class="text-center">Kategori</th>
              <th class="text-center">Harga</th>
              <th class="text-center">Jumlah</th>
              @if (session('role_id') == 1)
              <th class="text-center">Aksi</th>
              @endif
            </tr>
          </thead>
          <tbody>
            @foreach ($items as $item)
              <tr id="{{ $item->id }}">
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->category->name }}</td>
                <td>Rp. {{ number_format($item->price, 2) }},-</td>
                <td>
                  @if ($item->value == 0)
                      <b class="text-danger">HABIS!!!</b>
                  @else
                      {{ $item->value }} Unit
                  @endif
                </td>
                @if (session('role_id') == 1)
                <td class="text-center d-flex justify-content-center">
                  <a aria-label="edit" href="/storages/{{ $item->id }}/edit">
                    <i class="bi bi-pencil-fill"></i>
                  </a>
                  <form action="/storages/{{ $item->id }}" method="post" id="formDeleteData">
                    @csrf
                    @method('delete')
                    <button type="submit" class="text-danger" id="btnDeleteData">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>
                </td>
                @endif
              </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <td colspan="7"><b>Total Barang : {{ count($items) }} Barang</b></td>
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
        title: 'Hapus Barang?',
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


