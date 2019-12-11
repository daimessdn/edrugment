@extends('layouts.master')

@section('title')
  Proses Produksi
@endsection

@section('content')
  {{-- {{ dd($data_rko) }} --}}
  <div class="card">
    <div class="card-header">
      <h1>Cek Produksi</h1>
    </div>
    <div class="card-body">
      <div class="row">

        {{-- tabel rencana kebutuhan obat --}}
        <div class="col-12">
          <p>Silahkan pilih rumah sakit yang akan diproses produksinya<br /><br /></p>
          <table class="table table-dark table-responsive">
            <tr>
              <th>Nama RS</th>
              <th>Alamat</th>
              <th>Kelurahan</th>
              <th>Kecamatan</th>
              <th>Kabupaen/Kota</th>
              <th>Provinsi</th>
            </tr>
            @foreach ($rs as $rsi)
              <tr>
                <td>
                  <a href="/produksi/{{$rsi->id}}">
                    {{ $rsi->nama_rs }}
                  </a>
                </td>
                <td>{{ $rsi->alamat }}</td>
                <td>{{ $rsi->kelurahan }}</td>
                <td>{{ $rsi->kecamatan }}</td>
                <td>{{ $rsi->kota }}</td>
                <td>{{ $rsi->provinsi }}</td>
              </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>
  </div>

@endsection