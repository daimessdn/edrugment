@extends('layouts.master')

@section('title')
  Produksi Obat
@endsection

@section('content')
  {{-- {{ dd($data_rko) }} --}}
  <div class="card">
    <div class="card-header">
      <h1>Produksi Obat</h1>
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
          @foreach ($item as $i)
            <table class="table table-dark table-responsive mb-2" style="overflow-x: auto; font-size: 13px; max-height: 360px">
              <tr>
                <th>Nama</th>
                <th>Satuan</th> 
                <th>Harga Satuan</th>
                <th>Stok sisa obat</th>
                <th>Rata-Rata Pemakaian (per bulan)</th>
                <th>Periode</th>
              </tr>  
            </table>
          @endforeach
        </div>
      </div>
    </div>
  </div>

@endsection