@extends('backend.layouts.app')
@section('title', 'Beranda | SPK-SAW')
{{-- @endsection --}}
@section('content')
                <!-- Awal Konten -->
                <div class="container-fluid">

                    <!-- Judul Halaman -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Beranda</h1>
                        @if ( Auth::user()->role != "Mahasiswa")
                        <a href="/tentang" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-info-circle"></i> Tentang Sistem</a>
                        @endif
                    </div>

                    <div>
                        @include('template.alert')
                    </div>

                    <!-- Isi Konten Utama -->
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card shadow mb-2">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Selamat Datang di
                                        <b>SISTEM PENDUKUNG KEPUTUSAN PENERIMAAN
                                            PERMOHONAN PENYESUAIAN UKT BAGI
                                            MAHASISWA POLITEKNIK NEGERI
                                            JEMBER</b>
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 20rem;" src="{{ url('assets/img/undraw_posting_photo.svg')}}" alt="gambar-dashboard">
                                    </div>
                                    <p>Halo, anda login sebagai ({{ Auth::user()->role }}). 
                                        @if ( Auth::user()->role == "Mahasiswa")
                                        Untuk melihat mekanisme cara pendaftaran bisa ke halaman <a class="btn btn-sm btn-primary" href="/pendaftaran">Pendaftaran</a> , dan untuk melihat hasil ke halaman <a class="btn btn-sm btn-primary" href="/hasilukt">Hasil</a> .
                                        @else
                                        Untuk melihat mekanisme cara kerja metode AHP bisa ke halaman (<a href="/tentang">Tentang Sistem</a>).
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>

                        @if (Auth::user()->role != "Mahasiswa")
                        <!-- Total Jumlah Kriteria -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Jumlah Kriteria</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($kriteria) }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-cube fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Total Jumlah Sub-Kriteria -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Mahasiswa</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($mahasiswa)}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (Auth::user()->role == "Admin")
                        <!-- Total Jumlah Sub-Kriteria -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                User</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($user)}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @else
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Formulir Pendaftaran Aktif</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($form)}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>

                </div>
                <!-- /.container-fluid -->
@endsection