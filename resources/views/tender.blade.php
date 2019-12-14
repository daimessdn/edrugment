@extends('layouts.master')

@section('title')
  Ambil Pesanan Produksi
@endsection

@section('content')
  {{-- {{ dd($data_rko) }} --}}
  <div class="card">
    <div class="card-header">
      <h1>Ambil Pesanan Produksi</h1>
    </div>
    <div class="card-body">
      <div class="row">
        @if (session('sukses'))
          <div class="col-12">
            <div class="alert alert-success mt-2">
              {{ session('sukses') }}
            </div>
          </div>
        @endif

        {{-- tabel rencana kebutuhan obat --}}
        <div class="col-12">
          @if ($count != 0)
            @foreach ($invoices as $inv)
              @if ($inv->stage == 2)
                <h4 class="mt-2 mb-2">
                  <span class="badge badge-warning">INVOICE #{{ $inv->id }}</span> : 
                  {{ $inv->rs->nama_rs }}
                </h4>
                <a href="/produksi/{{ $inv->id }}/book" class="btn btn-primary btn-sm mb-2">Ambil pesanan</a>
                <table class="table table-dark table-responsive mb-2" style="overflow-x: auto; font-size: 13px; max-height: 360px">
                  <tr>
                    <th>Nama</th>
                    <th>Satuan</th>
                    <th>Harga Satuan</th>
                    <th>Stok sisa obat</th>
                    <th>Rata-Rata Pemakaian (per bulan)</th>
                    <th>Periode</th>
                  </tr>

                  @foreach ($inv->rko as $rko)
                    @if($rko->produced == 0)
                      <tr>
                        <td>{{ $rko->med_name }}</td>
                        <td>{{ $rko->unit }}</td>
                        <td>{{ $rko->price }}</td>
                        <td>{{ $rko->stock }}</td>
                        <td>{{ $rko->use_avg }}</td>
                        <td>{{ $rko->periode1 }} - {{ $rko->periode2 }}</td>
                      </tr>
                    @endif
                  @endforeach
                </table>
              @endif
            @endforeach
          @endif
        </div>
      </div>
    </div>
  </div>

@endsection