@extends('backend.layouts.app')
@section('title', 'Tambah Kriteria | SPK-AHP')
{{-- @endsection --}}
@section('content')
<div class="container-fluid grid-margin stretch-card">
    <!-- Judul Halaman -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tambah Kriteria</h1>
        </div>
        <div class="card">
            <div class="card-body">
                @if (!empty(session('error')))
                    <div class="alert alert-danger text-center" role="alert">
                        <i class="fas fa-ban"></i> {{ session('error') }}
                    </div>
                @endif
                <form class="needs-validation" method="POST" action="/tambahkt">
                    @csrf
                    <div class="form-group">
                        <label for="nama_kriteria">Nama Kriteria</label>
                        <input type="text" class="form-control form-control-user @error('nama_kriteria') is-invalid @enderror" id="nama_kriteria" placeholder="Masukkan Nama Kriteria"
                            name="nama_kriteria">
                        <small id="namaHelp" class="form-text text-muted">Contoh: Penghasilan Ortu.</small>
                        @error('nama_kriteria')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="jenis">Jenis Kriteria</label>
                        <select 
                            class="form-control form-control-user @error('jenis') is-invalid @enderror" 
                            id="jenis" 
                            name="jenis">
                            <option value="">-- Pilih Jenis Kriteria --</option>
                            <option value="benefit">Benefit</option>
                            <option value="cost">Cost</option>
                        </select>
                        <small id="jenisHelp" class="form-text text-muted">Benefit = semakin besar semakin baik, Cost = semakin kecil semakin baik.</small>
                        @error('jenis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-6 text-left">
                            <a href="/kriteria" class="btn btn-dark"><i class="fas fa-arrow-left"></i> Kembali</a>
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