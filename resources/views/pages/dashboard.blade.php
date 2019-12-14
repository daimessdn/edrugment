@extends('layouts.master')

@section('title')
  Dashboard
@endsection

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12">
      @if (session('sukses'))
        <div class="alert alert-success mt-2">
          {{ session('sukses') }}
        </div>
      @endif
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3>Pemberitahuan</h3>
            </div>
            
            <div class="card-body">
              @if ($count != 0)
                <table class="table table-dark">
                  @foreach ($messages as $msg)
                    <tr>
                      <td>
                        <span class="badge badge-warning">{{ $msg->created_date }}</span><br />
                        {{ $msg->content }}<br />
                        <a href="/dashboard/{{ $msg->id }}/dismiss" class="btn btn-primary btn-sm">DISMISS</a>
                      </td>
                    </tr>
                  @endforeach
                </table>
              @else
                <p>Anda belum memiliki pemberitahuan.</p>
              @endif
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3>Perlu Bantuan?</h3>
            </div>
            
            <div class="card-body">
              @if ($user->roleid == 1)
                <p>
                  Jika ini adalah pertama kali Anda mengakses SIMBAT (Sistem Manajemen Obat), maka Anda bisa melakukan beberapa hal berikut.<br/>
                </p>
                <table class="table table-striped table-bordered">
                  <tr>
                    <td>
                      <strong>Mengisi data RKO</strong> : Anda dapat mengisi RKO dengan menuju laman <a href="/rko">"Rencana Kebutuhan Obat (RKO)"</a>, lalu bisa mengisi data secara manual dengan klik <strong>"Tambah Obat"</strong> atau import data RKO melalui Excel dengan klik <strong>"Tambah dari Excel"</strong>.
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <strong>Melihat status RKO</strong> : Anda dapat melihat status RKO dengan menuju laman <a href="/rko/status">"Status RKO"</a>, lalu bisa melihat status RKO apakah RKO dalam status <strong>pending</strong>, <strong>diterima</strong>, atau <strong>ditolak</strong>.
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <strong>Melihat invoice RKO</strong> : Anda dapat melihat invoice RKO yang telah disubmit dengan menuju laman <a href="/rko/history">"Invoice RKO"</a>, lalu bisa melihat invoice RKO dalam bentuk <strong>QR code</strong> maupun dalam bentuk <strong>PDF</strong>.
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <strong>Mengganti kata sandi</strong> : Anda dapat mengganti kata sandi Anda dengan menuju laman <a href="/profil">"Profil Apoteker"</a>, lalu mengisikan kata sandi baru Anda.
                    </td>
                  </tr>
                </table>
              @elseif ($user->roleid == 2)
                <p>Anda belum memiliki pemberitahuan.</p>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection