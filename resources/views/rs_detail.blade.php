@extends('layouts.master')

@section('title')
  Detail Rumah Sakit
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
            <h3>Profil Rumah Sakit</h3>
          </div>
            
          <div class="card-body">
            <img id="profile-photo"
                 class="mt-1 mb-2"
                 src="https://mk0ehealtheletsj3t14.kinstacdn.com/wp-content/uploads/2009/07/best-hospital-in-south-india.jpg"
                 style="width: 65%" />
            <h3>{{ $rs->nama_rs }}</h3>
            <p>
              {{ $rs->alamat }}<br />
              {{ $rs->kelurahan }}, {{ $rs->kecamatan }}<br />
              Kabupaten/Kota {{ $rs->kota }}<br />
              
              {{ $rs->provinsi }}
            </p>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3>Detail RKO</h3>
          </div>
          
          <div class="card-body">
            {{-- {{ $datacount }} --}}
            @if ($datacount != 0)
              <table class="table table-dark table-responsive" style="overflow-x: auto; font-size: 13px; max-height: 400px;">
                <tr>
                  <th>#INVOICE<br/>ID</th>
                  <th>Nama</th>
                  <th>Satuan</th>
                  <th>Harga Satuan</th>
                  <th>Stock</th>
                  <th>Rata-Rata Pemakaian</th>
                  <th>Periode</th>
                </tr>

                @foreach ($data_rko as $rko)
                  @if ($rko->submitted == 1 and $rko->approved == 0)
                    <tr>
                      <td>{{ $rko->invoice_id }}</td>
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
              
              <a href="/process" class="btn btn-primary btn-sm mt-2">Proses RKO</a>
            @else
              Data RKO belum dikumpulkan oleh pihak rumah sakit yang bersangkutan.
            @endif
          </div>
        </div>
      </div>

      @if($rs->map_url)
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3>Alamat Rumah Sakit</h3>
            </div>
            <div class="card-body">
              <iframe src="{{ $rs->map_url }}"
                      width="100%"
                      height="450"
                      frameborder="0"
                      style="border:0;"
                      allowfullscreen="">
              </iframe>
            </div>
          </div>
        </div>
      @endif

    </div>
  </div>
@endsection