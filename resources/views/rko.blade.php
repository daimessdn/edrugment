@extends('layouts.master')

@section('title')
  Rencana Kebutuhan Obat (RKO)
@endsection

@section('content')
  {{-- {{ dd($data_rko) }} --}}
  <div class="card">
    <div class="card-header">
      <h1>Rencana Kebutuhan Obat (RKO)</h1>
    </div>
    <div class="card-body">
      <div class="row">
        
        <div class="col-md-12">
          @if (session('sukses'))
            <div class="alert alert-success mt-2">
                {{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button> --}}
              {{ session('sukses') }}
            </div>
          @endif
        </div>
    
        <!-- Button trigger modal -->
        <div class="col-12 mb-1">
          <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#rkoAddModal">
            <strong>+</strong> Tambah obat
          </button>
          <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#rkoImportModal">
            <strong>+</strong> Tambah dari Excel
          </button>
        </div>

        {{-- tabel rencana kebutuhan obat --}}
        <div class="col-12">
          @if ($datacount != 0)
            <table class="table table-dark table-responsive" style="overflow-x: auto; font-size: 13px; max-height: 360px">
              <tr>
                <th>Nama</th>
                <th>Satuan</th>
                <th>Harga Satuan</th>
                <th>Stok sisa obat</th>
                <th>Rata-Rata Pemakaian (per bulan)</th>
                <th>Periode</th>
              </tr>
              @foreach ($data_rko as $rko)
                @if($rko->submitted == 0)
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

            <a href="/rko/export" class="btn btn-primary btn-sm mt-2">Unduh data RKO</a> <br/>
            <a href="#" class="btn btn-primary btn-sm mt-2"  data-toggle="modal" data-target="#submitModal">Submit data RKO</a>
          @else
            <p>Belum ada data RKO yang diinput. Silahkan menambahkan data RKO melalui <strong>input manual</strong> atau <strong>import data melalui upload file excel</strong>.</p>
          @endif
        </div>
      </div>
    </div>
  </div>

@endsection