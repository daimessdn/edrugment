@extends('layouts.master')

@section('title')
  Profil
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
						</i>
						Profil 
						@if (auth()->user()->roleid == 0)
							Administrator
						@elseif (auth()->user()->roleid == 1)
							Apoteker
						@elseif (auth()->user()->roleid == 2)
							Tender Produksi
						@endif
					</h3>
				</div>
		
				<div class="card-body">
					<div id="profile-desc" class="container mb-4">
						<div class="row">
							<div class="col-12" align="center">
								<img id="profile-photo"
									 src="https://cdn1.iconfinder.com/data/icons/navigation-elements/512/user-login-man-human-body-mobile-person-512.png"
									 style="border-radius: 50%; width: 120px" />
								<h3>{{ auth()->user()->name }}</h3>
								<p>
									{{ auth()->user()->email }}<br />
									@if (auth()->user()->roleid == 0)
										Administrator
									@elseif (auth()->user()->roleid == 1)
										Apoteker di {{ auth()->user()->rs->nama_rs }}
									@elseif (auth()->user()->roleid == 2)
										Tender Produksi
									@endif
								</p>
								<p>
									<a href="/signout" class="btn btn-primary btn-sm mt-2">Logout</a>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h3>
						Ubah kata sandi
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
	</div>

@endsection