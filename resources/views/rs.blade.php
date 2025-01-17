@extends('layouts.master')

@section('title')
  Daftar Rumah Sakit
@endsection

@section('content')
  {{-- {{ dd($data_rko) }} --}}
  <div class="card">
    <div class="card-header">
      <h1>Daftar Rumah Sakit</h1>
    </div>
    <div class="card-body">
      <div class="row">

        {{-- tabel rencana kebutuhan obat --}}
        <div class="col-12">
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
                  <a href="/rs/{{$rsi->id}}/detail">
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