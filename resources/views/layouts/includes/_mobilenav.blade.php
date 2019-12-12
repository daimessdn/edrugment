<nav class="navbar-mobile">
    <div class="container-fluid">
        <ul class="navbar-mobile__list list-unstyled">
            {{-- <li class="has-sub">
                <a class="js-arrow" href="/">
                    <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                    <li>
                        <a href="/">Dashboard</a>
                    </li>
                    <li>
                        <a href="/rko">Rencana Kebutuhan Obat</a>
                    </li>
                    <li>
                        <a href="/rs">Daftar Rumah Sakit</a>
                    </li>
                    <li>
                        <a href="/profile">Profil</a>
                    </li>
                </ul>
            </li> --}}
            <li>
                <a href="/dashboard">
                    <i class="fas fa-tachometer-alt"></i>
                    Dasbor
                </a>
            </li>

            @if (auth()->user()->roleid == 1)
               <li>
                  <a href="/rko">
                     <i class="fas fa-medkit"></i>
                     Rencana Kebutuhan Obat (RKO)
                  </a>
               </li>
            @endif

            @if (auth()->user()->roleid == 1)
               <li>
                  <a href="/rko/status">
                     <i class="fas fa-medkit"></i>
                     Status RKO
                  </a>
               </li>
            @endif
            
            @if (auth()->user()->roleid == 0)
               <li>
                  <a href="/rs">
                     <i class="fas fa-hospital-o"></i>
                     Daftar Rumah Sakit
                  </a>
               </li>
            @endif

            @if (auth()->user()->roleid == 2)
               <li>
                  <a href="/produksi">
                     <i class="fas fa-truck"></i>
                     Ambil Pesanan Produksi
                  </a>
               </li>
            @endif

            @if (auth()->user()->roleid == 2)
               <li>
                  <a href="#">
                     <i class="fas fa-truck"></i>
                     Pengolahan Obat
                  </a>
               </li>
            @endif
               
            <li>
               <a href="/profil">
                  <i class="fas fa-user"></i>
                  Profil 
                  @if (auth()->user()->roleid == 0)
                     Administrator
                  @elseif (auth()->user()->roleid == 1)
                     Apoteker
                  @elseif (auth()->user()->roleid == 2)
                     Tender Produksi
                  @endif
               </a>
            </li>

            @if (auth()->user()->roleid == 0)
               <li>
                  <a href="/users">
                     <i class="fas fa-users"></i>
                     Registrasi Pengguna
                  </a>
               </li>
            @endif
        </ul>
    </div>
</nav>