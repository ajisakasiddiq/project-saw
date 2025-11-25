<!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Judul -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fa fa-code mr-2"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SPK-SAW</div>
            </a>

            <!-- Sidebar Profil -->
            <div class="sidebar-card d-none d-lg-flex">
                <img class="sidebar-card-illustration rounded mb-2" src="{{ url('picture/accounts/'. Auth::user()->foto)}}" alt="gambar-user">
                <p class="text-center mb-2"><strong>{{ Auth::user()->nama}}</strong></p>
                <a class="btn btn-success btn-sm" href="/profil"><i class="fas fa-user"></i> Profil</a>
            </div>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Beranda -->
            <li class="nav-item {{ Request::is('beranda') ? 'active' : '' }}">
                <a class="nav-link" href="/beranda">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Beranda</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            @if(Auth::user()->role == "Mahasiswa")
            <!-- Heading -->
            <div class="sidebar-heading">
                Pengajuan
            </div>

            <!-- Nav Item - Pendaftaran -->
            <li class="nav-item {{Request::is('pendaftaran') ? 'active' : ''}}{{Request::is('detail*') ? 'active' : ''}}">
                <a class="nav-link" href="/pendaftaran">
                    <i class="fas fa-fw fa-edit"></i>
                    <span>Pendaftaran</span></a>
            </li>
            <li class="nav-item {{Request::is('hasilukt') ? 'active' : ''}}">
                <a class="nav-link" href="/hasilukt">
                    <i class="fas fa-fw fa-list"></i>
                    <span>Hasil</span></a>
            </li>
            @endif
            
            @if(Auth::user()->role != "Mahasiswa")
            <!-- Heading -->
            <div class="sidebar-heading">
                Data Master
            </div>

            <!-- Nav Item - Kriteria & Sub-Kriteria -->
                @if(Request::is('kriteria'))
                    <?php 
                    $status = 'active show';
                    ?>
                    @elseif(Request::is('preferensikt'))
                    <?php $status = 'active show';
                    ?>
                    @elseif(Request::is('tambahkt'))
                    <?php $status = 'active show';
                    ?>
                    @elseif(Request::is('editkt*'))
                    <?php $status = 'active show';
                    ?>
                    @elseif(Request::is('sub'))
                    <?php $status = 'active show';
                    ?>
                    @elseif(Request::is('preferensisb'))
                    <?php $status = 'active show';
                    ?>
                    @elseif(Request::is('tambahsb'))
                    <?php $status = 'active show';
                    ?>
                    @elseif(Request::is('editsb*'))
                    <?php $status = 'active show';
                    ?>
                    @else
                    <?php $status = ''?>
                @endif
            <li class="nav-item 
            {{Request::is('kriteria') ? 'active' : ''}}
            {{Request::is('sub') ? 'active' : ''}}
            {{Request::is('tambahkt') ? 'active' : ''}}
            {{Request::is('editkt*') ? 'active' : ''}}
            {{Request::is('preferensikt') ? 'active' : ''}}
            {{Request::is('tambahsb') ? 'active' : ''}}
            {{Request::is('editsb*') ? 'active' : ''}}
            {{Request::is('preferensisb') ? 'active' : ''}}
            ">
            </li>

            <!-- Nav Item - Mahasiswa -->
            <li class="nav-item {{Request::is('kriteria') ? 'active' : ''}}{{Request::is('tambahkt') ? 'active' : ''}}{{Request::is('editkt*') ? 'active' : ''}}">
                <a class="nav-link" href="/kriteria">
                     <i class="fas fa-fw fa-cubes"></i>
                    <span>Kriteria</span></a>
            </li>
            <li class="nav-item {{Request::is('mahasiswa') ? 'active' : ''}}{{Request::is('tambahmh') ? 'active' : ''}}{{Request::is('editmh*') ? 'active' : ''}}">
                <a class="nav-link" href="/mahasiswa">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Mahasiswa</span></a>
            </li>

            @if (Auth::user()->role == "Admin")
            <!-- Nav Item - User -->
            <li class="nav-item {{ Request::is('user') ? 'active' : '' }}{{Request::is('tambahuc') ? 'active' : ''}}{{Request::is('edituc*') ? 'active' : ''}}">
                <a class="nav-link" href="/user">
                    <i class="fas fa-fw fa-user"></i>
                    <span>User</span></a>
            </li>
            @endif
            <!-- Nav Item - Formulir -->
            <li class="nav-item {{ Request::is('formulir') ? 'active' : '' }}{{Request::is('tambahfm') ? 'active' : ''}}{{Request::is('editfm*') ? 'active' : ''}}">
                <a class="nav-link" href="/formulir">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Formulir</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Perhitungan & Hasil
            </div>
            @if (Auth::user()->role == "Admin")
            <!-- Nav Item - Charts -->
            <li class="nav-item {{ Request::is('hitung') ? 'active' : '' }}{{Request::is('detail*') ? 'active' : ''}}">
                <a class="nav-link" href="/hitung">
                    <i class="fas fa-fw fa-calculator"></i>
                    <span>Perhitungan</span></a>
            </li>
            @endif

            <li class="nav-item {{Request::is('lis*') ? 'active' : ''}}">
                <a class="nav-link" href="/list">
                    <i class="fas fa-fw fa-list"></i>
                    <span>Hasil Penentuan</span></a>
            </li>

            
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            
            <li class="nav-item {{ Request::is('tentang') ? 'active' : '' }}">
                <a class="nav-link" href="/tentang">
                    <i class="fas fa-fw fa-info-circle"></i>
                    <span>Tentang</span></a>
            </li>
            @endif

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->