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
                <p class="mb-2">
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
              @elseif ($user->roleid == 0)
              <p class="mb-2">
                Jika ini adalah pertama kali Anda mengakses SIMBAT (Sistem Manajemen Obat), maka Anda bisa melakukan beberapa hal berikut.<br/>
              </p>
              <table class="table table-striped table-bordered">
                <tr>
                  <td>
                    <strong>Melihat daftar rumah sakit</strong> : Anda dapat melihat daftar rumah sakit dengan menuju laman <a href="/rs">"Daftar Rumah Sakit"</a>, lalu bisa melihat <strong>daftar rumah sakit</strong> yang tersedia. Anda juga dapat melihat rincian rumah sakit dengan klik salah satu <strong>nama rumah sakit</strong>.
                  </td>
                </tr>
                <tr>
                  <td>
                    <strong>Memproses invoice RKO</strong> : Anda dapat memproses invoice RKO dengan menuju laman <a href="/process">"Proses RKO"</a>, lalu memilih apakah RKO diterima dengan klik "<strong>Terima RKO</strong>" atau tidak dengan klik "<strong>Tolak RKO</strong>".
                  </td>
                </tr>
                <tr>
                  <td>
                    <strong>Registrasi user</strong> : Anda dapat mendaftarkan user baru dengan menuju laman <a href="/users">"Registrasi Pengguna"</a>, lalu mengisikan data berupa "<strong>Nama</strong>", "<strong>Email</strong>", dan "<strong>Role</strong>" user tersebut.
                  </td>
                </tr>
                <tr>
                  <td>
                    <strong>Mengganti kata sandi</strong> : Anda dapat mengganti kata sandi Anda dengan menuju laman <a href="/profil">"Profil Tender Produksi"</a>, lalu mengisikan kata sandi baru Anda.
                  </td>
                </tr>
              </table>
              @else
              <p class="mb-2">
                Jika ini adalah pertama kali Anda mengakses SIMBAT (Sistem Manajemen Obat), maka Anda bisa melakukan beberapa hal berikut.<br/>
              </p>
              <table class="table table-striped table-bordered">
                <tr>
                  <td>
                    <strong>Mengambil pesanan RKO</strong> : Anda dapat mengambil pesanan RKO dengan menuju laman <a href="/produksi">"Ambil Pesanan Produksi"</a>, lalu bisa memilih pesanan RKO berdasarkan invoice yang ada dengan klik salah satu atau dua tombol <strong>"Ambil Pesanan"</strong>.
                  </td>
                </tr>
                <tr>
                  <td>
                    <strong>Mengisi data produksi obat</strong> : Anda dapat mengisi data produksi obat dengan menuju laman <a href="/manage">"Pengolahan Obat"</a>, lalu bisa mengisi <strong>jumlah masing-masing obat</strong> yang akan diproduksi dan <strong>estimasi waktu produksinya</strong>.
                  </td>
                </tr>
                <tr>
                  <td>
                    <strong>Mengganti kata sandi</strong> : Anda dapat mengganti kata sandi Anda dengan menuju laman <a href="/profil">"Profil Tender Produksi"</a>, lalu mengisikan kata sandi baru Anda.
                  </td>
                </tr>
              </table>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection