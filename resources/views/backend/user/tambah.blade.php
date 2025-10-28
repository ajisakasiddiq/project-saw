@extends('backend.layouts.app')
@section('title', 'Tambah User | SPK-AHP')
{{-- @endsection --}}
@section('content')
<div class="container-fluid grid-margin stretch-card">
    <!-- Judul Halaman -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tambah User</h1>
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
                <form class="needs-validation" method="POST" action="/tambahuc" enctype="multipart/form-data">
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
                        <label for="nama">Nama User</label>
                        <input type="text" class="form-control form-control-user @error('nama') is-invalid @enderror" id="nama" placeholder="Masukkan Nama"
                            name="nama">
                        <small id="namaHelp" class="form-text text-muted">Contoh: Admin atau Pengelola dll.</small>
                        @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="email" placeholder="Masukkan Email"
                        name="email">
                        <small id="emailHelp" class="form-text text-muted">Masukkan email yang aktif, karena  dibutuhkan untuk verifikasi email.</small>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="role">Akses</label>
                        <select class="custom-select @error('role') is-invalid @enderror" name="role" id="role">
                            <option value="">-- Pilih Akses --</option>
                            <option value="Pengelola">Pengelola</option>
                            <option value="Mahasiswa">Mahasiswa</option>
                        </select>
                        <small id="roleHelp" class="form-text text-muted">Pilih akses (role) untuk user yang akan dibuat.</small>
                        @error('role')
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
                            <a href="/user" class="btn btn-dark"><i class="fas fa-arrow-left"></i> Kembali</a>
                        </div>
                        <div class="col-md-6 text-right">
                            <button type="submit" class="btn btn-primary me-2"><i class="fas fa-save"></i> Tambah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection