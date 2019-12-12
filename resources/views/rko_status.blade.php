@extends('layouts.master')

@section('title')
  Status RKO
@endsection

@section('content')
<div class="container">
  <div class="row d-flex flex-row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3>Status RKO</h3>
        </div>
          
        <div class="card-body">
          <div class="row">
            <div class="col-md-4">
              <h3>RKO yang pending</h3>
              @if ($datacount[0] != 0)
                <table class="table table-dark table-responsive mb-4 mt-2" style="overflow-x: auto; font-size: 13px; max-height: 400px;">
                  <tr>
                    <th>Nama</th>
                    <th>Satuan</th>
                    <th>Harga Satuan</th>
                    <th>Stock</th>
                    <th>Rata-Rata Pemakaian</th>
                    <th>Periode</th>
                    <th>Status</th>
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
                        <td>
                          @if ( $rko->pivot->approved == 0 )
                            Belum diverifikasi
                          @elseif ( $rko->pivot->approved == 1 )
                            Disetujui <br />
                            @if ( $rko->pivot->produced == 0 )
                              Belum diproduksi
                            @elseif ( $rko->pivot->produced == 1 )
                              Dalam proses produksi
                            @else
                              Sudah diproduksi
                            @endif
                          @else
                            Ditolak
                          @endif
                        </td>
                      </tr>
                    @endif
                  @endforeach
                </table>
                @else
                  <p class="mb-4">Belum ada data RKO yang diproses untuk saat ini.</p>
                @endif
            </div>

            <div class="col-md-4">
              <h3>RKO yang diterima</h3>
                @if ($datacount[1] != 0)
                <table class="table table-dark table-responsive mb-4 mt-2" style="overflow-x: auto; font-size: 13px; max-height: 400px;">
                  <tr>
                    <th>Nama</th>
                    <th>Satuan</th>
                    <th>Harga Satuan</th>
                    <th>Stock</th>
                    <th>Rata-Rata Pemakaian</th>
                    <th>Periode</th>
                    <th>Status</th>
                  </tr>
    
                  @foreach ($data_rko as $rko)
                    @if ($rko->pivot->submitted == 2 and $rko->pivot->approved == 1)
                      <tr>
                        <td>{{ $rko->med_name }}</td>
                        <td>{{ $rko->unit }}</td>
                        <td>{{ $rko->price }}</td>
                        <td>{{ $rko->stock }}</td>
                        <td>{{ $rko->use_avg }}</td>
                        <td>{{ $rko->pivot->periode1 }} - {{ $rko->pivot->periode2 }}</td>
                        <td>
                          @if ( $rko->pivot->approved == 0 )
                            Belum diverifikasi
                          @elseif ( $rko->pivot->approved == 1 )
                            Disetujui <br />
                            @if ( $rko->pivot->produced == 0 )
                              Belum diproduksi
                            @elseif ( $rko->pivot->produced == 1 )
                              Dalam proses produksi
                            @else
                              Sudah diproduksi
                            @endif
                          @else
                            Ditolak
                          @endif
                        </td>
                      </tr>
                    @endif
                  @endforeach
                </table>
                @else
                <p class="mb-4">Belum ada data RKO yang diterima.</p>
                @endif
            </div>

            <hr />

            <div class="col-md-4">
              <h3>RKO yang ditolak</h3>
                @if ($datacount[2] != 0)
                <table class="table table-dark table-responsive mb-4 mt-2" style="overflow-x: auto; font-size: 13px; max-height: 400px;">
                  <tr>
                    <th>Nama</th>
                    <th>Satuan</th>
                    <th>Harga Satuan</th>
                    <th>Stock</th>
                    <th>Rata-Rata Pemakaian</th>
                    <th>Periode</th>
                    <th>Status</th>
                  </tr>
    
                  @foreach ($data_rko as $rko)
                    @if ($rko->pivot->submitted == 2 and $rko->pivot->approved == 2)
                      <tr>
                        <td>{{ $rko->med_name }}</td>
                        <td>{{ $rko->unit }}</td>
                        <td>{{ $rko->price }}</td>
                        <td>{{ $rko->stock }}</td>
                        <td>{{ $rko->use_avg }}</td>
                        <td>{{ $rko->pivot->periode1 }} - {{ $rko->pivot->periode2 }}</td>
                        <td>
                          @if ( $rko->pivot->approved == 0 )
                            Belum diverifikasi
                          @elseif ( $rko->pivot->approved == 1 )
                            Disetujui <br />
                            @if ( $rko->pivot->produced == 0 )
                              Belum diproduksi
                            @elseif ( $rko->pivot->produced == 1 )
                              Dalam proses produksi
                            @else
                              Sudah diproduksi
                            @endif
                          @else
                            Ditolak
                          @endif
                        </td>
                      </tr>
                    @endif
                  @endforeach
                </table>
                @else
                <p class="mb-4">Belum ada data RKO yang ditolak.</p>
                @endif
            </div>
          </div>

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection