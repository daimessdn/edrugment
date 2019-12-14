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
          @if ($count != 0)
            @foreach ($invoices as $inv)
              <h4 class="mt-2 mb-2">
                <span class="badge badge-warning">INVOICE #{{ $inv->id }}</span> : 
                {{ $inv->rs->nama_rs }}
              </h4>
              <table class="table table-dark table-responsive mb-2" style="overflow-x: auto; font-size: 13px; max-height: 360px">
                <tr>
                  <th>Nama</th>
                  <th>Periode</th>
                  <th>Jumlah produksi</th>
                  <th>Isikan jumlah produksi</th>
                </tr>

                @foreach ($inv->rko as $rko)
                  <tr>
                    <td>{{ $rko->med_name }}</td>
                    <td>{{ $rko->periode1 }} - {{ $rko->periode2 }}</td>
                    <td>{{ $rko->quantity }}</td>
                    <form action="/manage/{{ $inv->id }}/{{ $rko->id }}/addQuantity" method="POST">
                      @csrf
                      <td>
                        <input class="form-control form-control-sm" type="number" name="quantity" required />
                      </td>
                      <td>
                        <button class="btn btn-sm btn-primary" type="submit">Set jumlah</button>
                      </td>
                    </form>
                  </tr>
                @endforeach
              </table>

              <form action="/manage/{{ $inv->id }}/produce" method="POST">
                @csrf
                <label class="my-1 mr-2" for="estimated">Estimasi waktu produksi (dalam hari): </label>
                <div class="input-group mb-2 mr-sm-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="fas fa-calendar"></i>
                    </div>
                  </div>
                  <input type="number" class="form-control" id="estimated" name="estimated">
                </div>
                <button class="btn btn-sm btn-primary" type="submit">Mulai produksi</button>
              </form>
            @endforeach
          @else
            <p>Anda belum mengambil pesanan. Silahkan pilih pesanan di laman "Ambil Pesanan Produksi"</p>
          @endif
        </div>
      </div>
    </div>
  </div>

@endsection