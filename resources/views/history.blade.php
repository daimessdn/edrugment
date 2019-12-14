@extends('layouts.master')

@section('title')
  Riwayat Rencana
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
            <h3>Riwayat Rencana</h3>
          </div>
            
          <div class="card-body">
            <table class="table table-dark">
              <tr>
                <th>INVOICE #</th>
                <th>Tanggal Dibuat</th>
                <th>QR CODE</th>
              </tr>
              @foreach ($invoices as $inv)
                <tr>
                  <td>{{ $inv->id }}</td>
                  <td>{{ $inv->created_at }}</td>
                  <td>
                    <img src="{{ asset('QR/'.$inv->id.'.png') }}"
                  </td>
                </tr>
              @endforeach
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection