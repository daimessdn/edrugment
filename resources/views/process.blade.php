@extends('layouts.master')

@section('title')
  Proses RKO
@endsection

@section('content')
  <div class="container">
    <div class="row d-flex flex-row">
      @if (session('sukses'))
        <div class="col-12">
          <div class="alert alert-success mt-2">
            {{ session('sukses') }}
          </div>
        </div>
      @endif
    
    <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3>Proses RKO</h3>
          </div>
            
          <div class="card-body">
            @if ($count != 0)
              @foreach ($invoices as $inv)
                <h3>Invoice #{{ $inv->id }}</h3>
                <h6 class="mb-2">{{ $inv->rs->nama_rs }}</h6>
                <table class="table table-dark table-responsive" style="max-height: 400px;">
                    <tr>
                      <th>Nama</th>
                      <th>Satuan</th>
                      <th>Harga Satuan</th>
                      <th>Stok sisa obat</th>
                      <th>Rata-Rata Pemakaian (per bulan)</th>
                      <th>Periode</th>
                    </tr>
                  @foreach ($inv->rko as $rko)
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

                <a href="/process/{{ $inv->id }}/approve" class="btn btn-primary btn-sm mt-2 mb-3">Terima RKO</a>
                <a href="/process/{{ $inv->id }}/decline" class="btn btn-danger btn-sm mt-2 mb-3">Tolak RKO</a>
              @endforeach
            @else
              <p>Belum ada rumah sakit yang mengumpulkan data RKO.</p>
            @endif            
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection