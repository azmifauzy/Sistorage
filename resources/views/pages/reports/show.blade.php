@extends('master')
@section('content')
<div class="container">
  <div class="card">
    <div class="card-header">
      <div class="card-title">
        <h6>Detail Laporan</h6>
        <a id="goToAddForm" target="_blank" href="/reports/{{ $report->id }}/generate-pdf" title="add item">
          <i class="bi bi-file-earmark-pdf-fill"></i>
          Print PDF 
        </a>
      </div>
    </div>
    <div class="card-body">
      <div class="row">
        <table class="table">
          <tbody>
            <tr>
              <th scope="row">Tahun : </th>
              <td>{{ $report->tahun }}</td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <th scope="row">Bulan : </th>
              <td>{{ $report->bulan }}</td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <th scope="row">Total Box : </th>
              <td colspan="2">{{ count($report->box) }} BOX - {{ $totalBarang }} Barang</td>
              <td></td>
            </tr>
            <tr>
              <th scope="row">Total Harga : </th>
              <td colspan="2">Rp. {{ number_format($totalHarga, 2) }},-</td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="row">
        <div class="card-body">
          <h6>Detail BOX</h6>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Kode Box</th>
                <th scope="col">Pengirim</th>
                <th scope="col">Penerima</th>
                <th scope="col">Barang Terjual</th>
                <th scope="col">Subtotal</th>
                <th scope="col">Tanggal Terkirim</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($report->box as $box)
              <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $box->id }}</td>
                <td>{{ $box->sender }}</td>
                <td>{{ $box->receiver }}</td>
                <td>{{ count($box->item) }} Barang</td>
                <td>Rp. {{ number_format($box->subtotal, 2) }},-</td>
                <td>{{ $box->date_sent }} {{ $report->bulan }} {{ $report->tahun }}</td>
                <td>
                    <a aria-label="edit" href="/boxes/{{ $box->id }}">
                      <i class="bi bi-eye text-primary"></i>
                    </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection