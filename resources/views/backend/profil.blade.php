@extends('backend.layouts.app')
@section('title', 'Profil User | SPK-AHP')
{{-- @endsection --}}
@section('content')
<div class="container-fluid grid-margin stretch-card">
    <!-- Judul Halaman -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Profil User</h1>
        </div>
        <div>
            @include('template.alert')
        </div>
        <div class="card">
            <div class="card-body">
                @if (!empty(session('error')))
                    <div class="alert alert-danger text-center" role="alert">
                        <i class="fas fa-ban"></i> {{ session('error') }}
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-8">
                        <form class="needs-validation" method="POST" action="/profil" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="gambar" class="form-label">Gambar</label>
                                <input class="form-control" type="file" id="gambar" name="gambar">
                                <small id="gambarHelp" class="form-text text-muted">Masukkan gambar maksimal ukuran (size) : 1Mb.</small>
                                @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama User ({{Auth::user()->role}})</label>
                                <input type="text"
                                @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'Pengelola')
                                {{''}}
                                @else
                                {{ 'readonly' }}
                                @endif
                                class="form-control form-control-user" id="nama"
                                    name="nama" value="{{ Auth::user()->nama }}">
                                <small id="namaHelp" class="form-text text-muted">Nama akun atau user.</small>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="email" placeholder="Masukkan Email"
                                name="email" value="{{ Auth::user()->email }}">
                                <small id="emailHelp" class="form-text text-muted">Masukkan email yang aktif, karena  dibutuhkan untuk verifikasi email.</small>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Sandi Akun</label>
                                <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" id="password" placeholder="Masukkan Sandi"
                                    name="password">
                                <small id="passwordHelp" class="form-text text-muted">Masukkan sandi, minimal 6 karakter.</small>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-6 text-left">
                                    <a href="{{ URL::previous() }}" class="btn btn-dark"><i class="fas fa-arrow-left"></i> Kembali</a>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="submit" class="btn btn-primary me-2"><i class="fas fa-save"></i> Ganti</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <div class="card" style="width: 18rem;">
                        <img src="{{ url('picture/accounts/'. Auth::user()->foto)}}" class="card-img-top" alt="photo-profil">
                            <div class="card-body">
                                <h5 class="card-title">{{ Auth::user()->nama}}</h5>
                                @if (Auth::user()->role == "Mahasiswa")
                                    <p class="card-text">{{$nama}}</p>
                                @endif
                                <p class="card-text">{{ Auth::user()->email}}</p>
                                @if (Auth::user()->role == "Admin")
                                    <span class="badge badge-primary">{{ Auth::user()->role }}</span>
                                @elseif (Auth::user()->role == "Pengelola")
                                    <span class="badge badge-info">{{ Auth::user()->role }}</span>
                                @else
                                    <span class="badge badge-dark">{{ Auth::user()->role }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection