@extends('layouts.master')

<!-- Modal -->
  <div class="modal fade" id="rkoAddModal" tabindex="-1" role="dialog" aria-labelledby="rkoAddModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="rkoAddModalLabel">Tambah Data RKO</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <form action="/rko/create" method="POST">
            {{ csrf_field() }}
            <div class="row">
              <div class="col-9">
                <div class="form-group">
                  <label for="med_name">Nama obat</label>
                  <input type="text" name="med_name" class="form-control form-control-sm" id="med_name" placeholder="Masukkan nama obat" required>
                </div>
              </div>

              <div class="col-3">
                <div class="form-group">
                  <label for="unit">Satuan</label>
                  <input type="text" name="unit" class="form-control form-control-sm" id="unit" required>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="med_name">Harga satuan</label>
              <div class="input-group">
                <div class="input-group-prepend input-group-sm">
                  <span class="input-group-text" id="pricePrepend">Rp</span>
                </div>
                <input type="number" name="price" step="0.01" class="form-control" id="price" required> 
              </div>
              <small class="form-text text-muted">Penulisan bisa ditulis dengan maksimal dua angka di belakang koma.</small>
            </div>

            <div class="form-group">
              <label for="stock">Stok obat tersisa</label>
              <input type="number" name="stock" class="form-control font-control-sm" id="stock" required>
            </div>

            <div class="form-group">
              <label for="use_avg">Konsumsi obat rata-rata per bulan</label>
              <input type="number" name="use_avg" step="0.01" class="form-control font-control-sm" id="use_avg" required>
              <small class="form-text text-muted">Penulisan bisa ditulis dengan maksimal dua angka di belakang koma.</small>
            </div>

            <div class="form-group">
              <label>Periode</label>
              <div class="input-group">
                <input type="date" name="periode1" class="form-control font-control-sm">
                <div class="input-group-prepend font-control-sm">
                  <span class="input-group-text" id="basic-addon1">-</span>
                </div>
                <input type="date" name="periode2" class="form-control font-control-sm" >
              </div>
            </div>
            
            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
          </form>
        </div>

        {{-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary  btn-sm" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary btn-sm">Save changes</button>
        </div> --}}

      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="rkoImportModal" tabindex="-1" role="dialog" aria-labelledby="rkoImportModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="rkoImportModalLabel">Import data RKO dari Excel</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <form action="/rko/import" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="file">Masukkan file yang akan diunggah</label>
              <input type="file" name="file" class="form-control form-control-sm" id="file" placeholder="Masukkan file..." required>
            </div>
            
            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
          </form>
        </div>

      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="submitModal" tabindex="-1" role="dialog" aria-labelledby="submitModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="submitModalLabel">Submit data RKO</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Yakin mau submit data RKO?</p>
          <p>*Segala data yang telah disubmit tidak dapat diubah maupun dikembalikan. Jadi, pastikan Anda sudah memastikan bahwa data yang diisi telah benar.
              <br />
              <br />
          </p> 
          <a href="rko/submit" class="btn btn-primary btn-sm">Submit</a>
        </div>

      </div>
    </div>
  </div>

@section('content')
  {{-- {{ dd($data_rko) }} --}}
  <div class="card">
    <div class="card-header">
      <h1>Rencana Kebutuhan Obat (RKO)</h1>
      @if (session('sukses'))
        <div class="alert alert-success mt-2">
            {{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button> --}}
          {{ session('sukses') }}
        </div>
      @endif
    </div>
    <div class="card-body">
      <div class="row">
      
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
          <table class="table table-dark table-responsive" style="overflow-x: auto;">
            <tr>
              <th>Nama</th>
              <th>Satuan</th>
              <th>Harga Satuan</th>
              <th>Stok sisa obat</th>
              <th>Rata-Rata Pemakaian (per bulan)</th>
              <th>Periode</th>
            </tr>
            @foreach ($data_rko as $rko)
              @if($rko->pivot->submitted == 0)
                <tr>
                  <td>{{ $rko->med_name }}</td>
                  <td>{{ $rko->unit }}</td>
                  <td>{{ $rko->price }}</td>
                  <td>{{ $rko->stock }}</td>
                  <td>{{ $rko->use_avg }}</td>
                <td>{{ $rko->pivot->periode1 }} - {{ $rko->pivot->periode2 }}</td>
                  <td>
                    <a href="/rko/{{ $rko->id }}/edit" class="btn btn-primary btn-sm">Edit</a>
                    <a href="/rko/{{ $rko->id }}/delete" class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau dihapus?');">Hapus</a>
                  </td>
                </tr>
              @endif
            @endforeach
          </table>

          <a href="/rko/export" class="btn btn-primary btn-sm mt-2">Unduh data RKO</a> <br/>
          <a href="#" class="btn btn-primary btn-sm mt-2"  data-toggle="modal" data-target="#submitModal">Submit data RKO</a>
        </div>
      </div>
    </div>
  </div>

@endsection