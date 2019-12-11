@extends('layouts.master')

@section('content')
<div class="card">
  <div class="card-header">
    <h1>Edit data obat</h1>
  </div>
  <div class="card-body">
    <form action="/rko/{{ $rko->id }}/update" method="POST">
      {{ csrf_field() }}
      <div class="row">
        <div class="col-9">
          <div class="form-group">
            <label for="med_name">Nama obat</label>
            <input type="text" name="med_name" class="form-control form-control-sm" id="med_name" placeholder="Masukkan nama obat" value="{{ $rko->med_name }}" required>
          </div>
        </div>

        <div class="col-3">
          <div class="form-group">
            <label for="unit">Satuan</label>
          <input type="text" name="unit" class="form-control form-control-sm" id="unit" value="{{ $rko->unit }}" required>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="med_name">Harga satuan</label>
        <div class="input-group">
          <div class="input-group-prepend input-group-sm">
            <span class="input-group-text" id="pricePrepend">Rp</span>
          </div>
          <input type="number" name="price" step="0.01" class="form-control" id="price" value="{{ $rko->price }}" required> 
        </div>
        <small class="form-text text-muted">Penulisan bisa ditulis dengan maksimal dua angka di belakang koma.</small>
      </div>

      <div class="form-group">
        <label for="stock">Stok obat tersisa</label>
        <input type="number" name="stock" class="form-control font-control-sm" id="stock" value="{{ $rko->stock }}" required>
      </div>

      <div class="form-group">
        <label for="use_avg">Konsumsi obat rata-rata per bulan</label>
        <input type="number" name="use_avg" step="0.01" class="form-control font-control-sm" id="use_avg" value="{{ $rko->use_avg }}" required>
        <small class="form-text text-muted">Penulisan bisa ditulis dengan maksimal dua angka di belakang koma.</small>
      </div>
      
      <button type="submit" class="btn btn-primary btn-sm">Submit</button>
    </form>
  </div>
</div>
@endsection