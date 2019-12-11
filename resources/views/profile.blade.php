@extends('layouts.master')

@section('content')
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
									Apoteker di {{ $usrs[0]->nama_rs }}
								@elseif (auth()->user()->roleid == 2)
									Tender Produksi
								@endif
							</p>
						</div>
					</div>
			</div>
		</div>
	</div>	

@endsection