@extends('master')
@section('content')
<div id="categories" class="container">
  <div class="d-grid gap-xl bg-white radius-xl p-sm">
    <div class="card">
      <div class="card-header">
        <div class=" d-flex justify-content-between">
          <h3 class="text-dark">
            Data Kategori
          </h3>
          @if (session('role_id') == 1)
              
            <a 
            id="goToAddForm" 
            href="/{{ strtolower($title) }}/create" 
            title="add item"
            >
            <i class="bi bi-plus-circle"></i> Tambah Kategori
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
        
        <table id="tableCategories" class="table table-bordered table-striped our-table">
          <thead>
            <tr>
              <th class="text-center">No</th>
              <th class="text-center">Name</th>
              @if (session('role_id') == 1)
              <th class="text-center">Aksi</th>
              @endif
            </tr>
          </thead>
          <tbody>
            @foreach ($categories as $category)
              <tr id="{{ $category->id }}">
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $category->name }}</td>
                @if (session('role_id') == 1)
                <td class="text-center d-flex justify-content-center">
                  <a href="/categories/{{ $category->id }}/edit" aria-label="edit">
                    <i class="bi bi-pencil-fill"></i>
                  </a>
                  <form action="/categories/{{ $category->id }}" method="POST" id="formDeleteData">
                    @csrf
                    @method('delete')
                    <button aria-label="delete" id="btnDeleteData">
                      <i class="bi bi-trash-fill"></i>
                    </button>
                  </form>
                </td>
                @endif
              </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <td colspan="3"><b>Total Kategori : {{ count($categories) }} Kategori</b></td>
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
        title: 'Hapus Kategori?',
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
    $(() => $("#tableCategories").DataTable())
  </script>
@endpush