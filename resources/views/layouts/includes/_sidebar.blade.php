<aside class="menu-sidebar d-none d-lg-block">
   <div class="logo">
      <a href="#">
         <img src="{{ asset('admin/logo/logo.jpeg') }}" alt="Cool Admin" />
      </a>
   </div>
   <div class="menu-sidebar__content js-scrollbar1">
      <nav class="navbar-sidebar">
         <ul class="list-unstyled navbar__list">
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
                     Produksi Obat
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
         </ul>
      </nav>
   </div>
</aside>