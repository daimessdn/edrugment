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

        {{-- tabel rencana kebutuhan obat --}}
        <div class="col-12">
          @foreach ($rs as $rsi)
            <h4 class="mt-2 mb-2">{{ $rsi->nama_rs }}</h4>
            <table class="table table-dark table-responsive mb-2" style="overflow-x: auto; font-size: 13px; max-height: 360px">
              <tr>
                <th>Nama</th>
                <th>Satuan</th>
                <th>Harga Satuan</th>
                <th>Stok sisa obat</th>
                <th>Rata-Rata Pemakaian (per bulan)</th>
                <th>Periode</th>
              </tr>

              @foreach ($rsi->user[0]->rko as $rko)
                @if($rko->pivot->submitted == 2 and $rko->pivot->approved == 1)
                  <tr>
                    <td>{{ $rko->med_name }}</td>
                    <td>{{ $rko->unit }}</td>
                    <td>{{ $rko->price }}</td>
                    <td>{{ $rko->stock }}</td>
                    <td>{{ $rko->use_avg }}</td>
                    <td>{{ $rko->periode1 }} - {{ $rko->periode2 }}</td>
                    <td>
                      <a href="/rko/{{ $rko->id }}/edit" class="btn btn-primary btn-sm">Edit</a>
                    </td>
                    <td>
                      <a href="/rko/{{ $rko->id }}/delete" class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau dihapus?');">Hapus</a>
                    </td>
                  </tr>
                @endif
              @endforeach
              
            </table>
          @endforeach
        </div>
      </div>
    </div>
  </div>

@endsection