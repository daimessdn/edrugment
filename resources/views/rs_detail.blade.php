@extends('layouts.master')


<div class="modal fade" id="prosesRKO" tabindex="-1" role="dialog" aria-labelledby="prosesRKOLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="prosesRKOLabel">Proses data RKO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Silahkan tekan <strong>'Terima Verifikasi'</strong> untuk menerima permintaan RKO rumah sakit yang bersangkutan, atau tekan <strong>'Tolak Verifikasi'</strong> untuk menolak data RKO rumah sakit<br /><br /></p>
        <p>*Segala data yang telah disubmit tidak dapat diubah maupun dikembalikan. Jadi, pastikan Anda sudah memastikan bahwa data yang diisi telah benar.
            <br />
            <br />
        </p> 
        <a href="/rs/{{ $rs->id }}/detail/approve" class="btn btn-primary btn-sm">Terima Verifikasi</a>
        <a href="/rs/{{ $rs->id }}/detail/decline" class="btn btn-danger btn-sm">Tolak Verifikasi</a>
      </div>

    </div>
  </div>
</div>

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
              <table class="table table-dark table-responsive" style="overflow-x: auto;">
                <tr>
                  <th>Nama</th>
                  <th>Satuan</th>
                  <th>Harga Satuan</th>
                  <th>Stock</th>
                  <th>Rata-Rata Pemakaian</th>
                  <th>Periode</th>
                </tr>

                @foreach ($data_rko as $rko)
                  @if ($rko->pivot->submitted == 1 and $rko->pivot->approved == 0)
                    <tr>
                      <td>{{ $rko->med_name }}</td>
                      <td>{{ $rko->unit }}</td>
                      <td>{{ $rko->price }}</td>
                      <td>{{ $rko->stock }}</td>
                      <td>{{ $rko->use_avg }}</td>
                      <td>{{ $rko->pivot->periode1 }} - {{ $rko->pivot->periode2 }}</td>
                    </tr>
                  @endif
                @endforeach
              </table>
              
              <a href="#" class="btn btn-primary btn-sm mt-2" data-toggle="modal" data-target="#prosesRKO">Proses RKO</a>
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