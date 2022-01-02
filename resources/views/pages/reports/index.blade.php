@extends('master')
@section('content')
<div id="items" class="container">
  <div class="d-grid gap-xl bg-white radius-xl p-sm">
    <div class="card">
      <div class="card-header">
        <div class=" d-flex justify-content-between">
          <h3 class="text-dark" id="cardHeader">
            Data Laporan
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
              <th class="text-center">Bulan</th>
              <th class="text-center">Tahun</th>
              <th class="text-center">Total Box</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($reports as $report)
              <tr id="{{ $report->id }}">
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $report->bulan }}</td>
                <td>{{ $report->tahun }}</td>
                <td>{{ count($report->box) }} BOX</td>
                <td class="text-center d-flex justify-content-center">
                  <a aria-label="edit" href="/reports/{{ $report->id }}">
                    <i class="bi bi-eye text-primary"></i>
                  </a>
                  <form action="/reports/{{ $report->id }}" method="post" id="formDeleteLaporan">
                    @csrf
                    @method('delete')
                    <button type="submit" aria-label="delete" id="btnDeleteLaporan">
                      <i class="bi bi-trash-fill"></i>
                    </button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <td colspan="6"><b>Total Laporan Bulanan : {{ count($reports) }} Laporan</b></td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
    $(document).on('click', '#btnDeleteLaporan', function(e) {
      e.preventDefault()
      Swal.fire({
        icon: 'warning',
        title: 'Hapus Laporan?',
        showCancelButton: true,
        confirmButtonText: 'Hapus',
      }).then((result) => {

        if (result.isConfirmed) {
          $(this).closest('#formDeleteLaporan').submit()
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
@endpush


