@extends('master')
@section('content')
<div id="items" class="container">
  <div class="d-grid gap-xl bg-white radius-xl p-sm">
    <div class="card">
      <div class="card-header">
        <div class=" d-flex justify-content-between">
          <h3 class="text-dark">
            Show All {{ $title }}
          </h3>
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
              <th class="text-center">Status</th>
              <th class="text-center">Role</th>
              <th class="text-center">Name</th>
              <th class="text-center">Email</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($cashiers as $kasir)
              <tr id="{{ $kasir->id }}">
                <td class="text-center">{{ $loop->iteration }}</td>
                <td class="text-center">{{ $kasir->status->name }}</td>
                <td class="text-center">{{ $kasir->role->name }}</td>
                <td>{{ $kasir->name }}</td>
                <td>{{ $kasir->email }}</td>
                <td class="text-center d-flex justify-content-center">
                  <a aria-label="edit" href="/cashiers/{{ $kasir->id }}/edit">
                    <i class="bi bi-pencil-fill"></i>
                  </a>
                  <form action="/cashiers/{{ $kasir->id }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" aria-label="delete">
                      <i class="bi bi-trash-fill"></i>
                    </button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <td colspan="6"><b>Total Kasir : {{ count($cashiers) }} Kasir</b></td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@push('data-table')
  @include('../../partials/data-table')
  <script>
    $(() => $("#tableItems").DataTable());
  </script>
@endpush


