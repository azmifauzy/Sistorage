<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Laporan Bulan {{ $report->bulan }}</title>
  </head>
  <body onload="window.print()">
    <div class="container">
        <div class="card">
          <div class="card-header">
            <div class="card-title">
              <h6>Detail Laporan Bulan {{ $report->bulan }}</h6>
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
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>