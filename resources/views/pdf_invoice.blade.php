<!DOCTYPE html>
<html lang="en">
<head>
  <title>Invoice Laporan RKO</title>
</head>
<body style="font-family:-apple-system, BlinkMacSystemFont, 'Helvetica Neue', 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', sans-serif">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h6>INVOICE #{{ $invoice->id }}</h6>
            <h1>{{ $invoice->rs->nama_rs }}</h1>
          </div>
          <div class="card-body">
            <table border="1" style="overflow-x: auto; font-size: 13px; max-height: 360px;">
              <tr>
                <th>Nama</th>
                <th>Satuan</th>
                <th>Harga Satuan</th>
                <th>Stok sisa obat</th>
                <th>Rata-Rata Pemakaian (per bulan)</th>
                <th>Periode</th>
              </tr>
              @foreach ($invoice->rko as $rko)
                <tr>
                  <td>{{ $rko->med_name }}</td>
                  <td>{{ $rko->unit }}</td>
                  <td>{{ $rko->price }}</td>
                  <td>{{ $rko->stock }}</td>
                  <td>{{ $rko->use_avg }}</td>
                  <td>{{ $rko->periode1 }} - {{ $rko->periode2 }}</td>
                </tr>
              @endforeach
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>