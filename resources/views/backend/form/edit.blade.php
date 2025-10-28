@extends('backend.layouts.app')
@section('title', 'Edit Formulir | SPK-AHP')
{{-- @endsection --}}
@section('content')
<div class="container-fluid grid-margin stretch-card">
    <!-- Judul Halaman -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Formulir</h1>
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
                @foreach ($form as $val)
                <form class="needs-validation" method="POST" action="/editfm/{{$val->id}}">
                    @csrf
                    <div class="form-group">
                        <label for="nama_form">Nama Formulir</label>
                        <input type="text" class="form-control form-control-user @error('nama_form') is-invalid @enderror" id="nama_form" placeholder="Masukkan Nama"
                            name="nama_form" value="{{$val->nama_form}}">
                        <small id="namaHelp" class="form-text text-muted">Bebas, contoh "Penuruan UKT Gelombang 1 (2024)".</small>
                        @error('nama_form')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="jenis">Jenis Formulir</label>
                        <select class="custom-select @error('jenis') is-invalid @enderror" name="jenis" id="jenis">
                            <option value="">-- Pilih Jenis --</option>
                            <option value="Pengangsuran UKT" {{ $val->jenis == "Pengangsuran UKT" ? 'selected' : '' }}>Pengangsuran UKT</option>
                            <option value="Penurunan UKT" {{ $val->jenis == "Penurunan UKT" ? 'selected' : '' }}>Penuruan UKT</option>
                        </select>
                        <small id="jenisHelp" class="form-text text-muted">Pilih (jenis) formulir, Pengangsuran atau Penurunan.</small>
                        @error('jenis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="status">Status Formulir</label>
                        <select class="custom-select @error('status') is-invalid @enderror" name="status" id="status">
                            <option value="">-- Pilih Akses --</option>
                            <option value="0" {{ $val->status == "0" ? 'selected' : '' }}>Tidak Aktif</option>
                            <option value="1" {{ $val->status == "1" ? 'selected' : '' }}>Aktif</option>
                            <option value="2" {{ $val->status == "2" ? 'selected' : '' }}>Tutup</option>
                        </select>
                        <small id="statusHelp" class="form-text text-muted">Pilih akses (status).</small>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-6 text-left">
                            <a href="/formulir" class="btn btn-dark"><i class="fas fa-arrow-left"></i> Kembali</a>
                        </div>
                        <div class="col-md-6 text-right">
                            <button type="submit" class="btn btn-primary me-2"><i class="fas fa-save"></i> Edit</button>
                        </div>
                    </div>
                </form>
                @endforeach
            </div>
        </div>
    </div>
@endsection