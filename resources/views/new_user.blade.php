@extends('layouts.master')

@section('title')
  Registrasi User
@endsection

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
					<form action="/users/create" method="POST">
						@csrf
						<div class="form-group">
							<label for="name">Nama user</label>
							<input type="text" name="name" class="form-control font-control-sm" required>
						</div>

						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" name="email" class="form-control font-control-sm" required>
						</div>

            <div class="form-group">
              <label for="role">Role</label>
              <select class="form-control form-control-sm" name="roleid">
                <option value="-999">Pilih...</option>
                <option value="1">Apoteker</option>
                <option value="2">Tender Produksi</option>
              </select>
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
      
          <div class="card-body" >
            @if ($users->count() != 1)
              <table class="table table-dark table-responsive" style="overflow: auto; height: 400px;">
                <tr>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Role</th>
                </tr>

                @foreach ($users as $user)
                  <tr>
                    @if ($user->roleid != 0)
                      <td>
                        {{ $user->name }}
                      </td>
                      <td>
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
                    @endif
                  </tr>
                @endforeach
              </table>
              <a href="/users/export" class="btn btn-primary btn-sm mt-2">Unduh data user</a>
            @else
              Belum ada user lain yang didaftarkan.
            @endif
          </div>
        </div>
      </div>
	</div>

@endsection