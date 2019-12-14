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
                    <th>Status</th>
                  </tr>
    
                  @foreach ($data_rko as $rko)
                    @if ($rko->submitted == 1 and $rko->approved == 0)
                    <tr>
                        <td>
                            <span class="badge badge-warning">INV #{{ $rko->invoice_id }}</span>
                            {{ $rko->med_name }} <br/>
                            <span class="badge badge-primary">{{ $rko->periode1 }} - {{ $rko->periode2 }}</span>
                        </td>
                        <td>
                          @if ( $rko->approved == 0 )
                            Belum diverifikasi
                          @elseif ( $rko->approved == 1 )
                            Disetujui <br />
                            @if ( $rko->produced == 0 )
                              Belum diproduksi
                            @elseif ( $rko->produced == 1 )
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
                    <th>Status</th>
                  </tr>
    
                  @foreach ($data_rko as $rko)
                    @if ($rko->submitted == 2 and $rko->approved == 1)
                      <tr>
                          <td>
                              <span class="badge badge-warning">INV #{{ $rko->invoice_id }}</span>
                              {{ $rko->med_name }} <br/>
                              <span class="badge badge-primary">{{ $rko->periode1 }} - {{ $rko->periode2 }}</span>
                          </td>
                        <td>
                          @if ( $rko->approved == 0 )
                            Belum diverifikasi
                          @elseif ( $rko->approved == 1 )
                            Disetujui <br />
                            @if ( $rko->produced == 0 )
                              Belum diproduksi
                            @elseif ( $rko->produced == 1 )
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
                    <th>Status</th>
                  </tr>
    
                  @foreach ($data_rko as $rko)
                    @if ($rko->submitted == 2 and $rko->approved == 2)
                    <tr>
                        <td>
                            <span class="badge badge-warning">INV #{{ $rko->invoice_id }}</span>
                            {{ $rko->med_name }} <br/>
                            <span class="badge badge-primary">{{ $rko->periode1 }} - {{ $rko->periode2 }}</span>
                        </td>
                        <td>
                          @if ( $rko->approved == 0 )
                            Belum diverifikasi
                          @elseif ( $rko->approved == 1 )
                            Disetujui <br />
                            @if ( $rko->produced == 0 )
                              Belum diproduksi
                            @elseif ( $rko->produced == 1 )
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