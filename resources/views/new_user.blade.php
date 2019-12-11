@extends('layouts.master')

@section('content')
	<div class="row">

		@if (session('sukses'))
      <div class="col-12">
        <div class="alert alert-success mt-2">
          {{ session('sukses') }}
        </div>
			</div>
		@elseif (session('error'))
      <div class="col-12">
        <div class="alert alert-danger mt-2">
          {{ session('error') }}
        </div>
      </div>
		@endif
		
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h3>
						Registrasi user baru
					</h3>
				</div>
		
				<div class="card-body">
					<form action="/profil/password/change" method="POST">
						@csrf
						<div class="form-group">
							<label for="new_pswd">Konfirmasi kata sandi baru</label>
							<input type="password" name="new_pswd" class="form-control font-control-sm" required>
						</div>

						<div class="form-group">
							<label for="con_pswd">Konfirmasi kata sandi baru</label>
							<input type="password" name="con_pswd" class="form-control font-control-sm" required>
						</div>

						<button type="submit" class="btn btn-primary btn-sm">Submit</button>
					</form>
				</div>
			</div>
    </div>
    
    <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3>
              Daftar user
            </h3>
          </div>
      
          <div class="card-body">
            @if ($users->count() != 1)
              <table class="table table-dark table-responsive" style="overflow-x: auto;">
                <tr>
                  <th>Nama</th>
                  <th>Role</th>
                </tr>

                @foreach ($users as $user)
                  <tr>
                    <td>
                      {{ $user->name }}<br>
                      {{ $user->email }}
                    </td>
                    <td>
                        @if ($user->roleid == 0)
                            Administrator
                        @elseif ($user->roleid == 1)
                            Apoteker
                        @elseif ($user->roleid == 2)
                            Tender Produksi
                        @endif
                    </td>
                  </tr>
                @endforeach
              </table>
              
              <a href="#" class="btn btn-primary btn-sm mt-2" data-toggle="modal" data-target="#prosesRKO">Proses RKO</a>
            @else
              Belum ada user lain yang didaftarkan.
            @endif
          </div>
        </div>
      </div>
	</div>

@endsection