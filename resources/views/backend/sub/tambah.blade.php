@extends('backend.layouts.app')
@section('title', 'Tambah Sub-Kriteria | SPK-AHP')
{{-- @endsection --}}
@section('content')
<div class="container-fluid grid-margin stretch-card">
    <!-- Judul Halaman -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tambah Sub-Kriteria</h1>
        </div>
        <div class="card">
            <div class="card-body">
                @if (!empty(session('error')))
                    <div class="alert alert-danger text-center" role="alert">
                        <i class="fas fa-ban"></i> {{ session('error') }}
                    </div>
                @endif
                <form class="needs-validation" method="POST" action="/tambahsb">
                    @csrf
                    <div class="form-group">
                        <label for="id_kriteria">Pilih Kriteria</label>
                        <select class="custom-select @error('id_kriteria') is-invalid @enderror" name="id_kriteria" id="id_kriteria">
                            <option value="">-- Pilih Kriteria --</option>
                            @foreach ($kriteria as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_kriteria }}</option>
                            @endforeach
                        </select>
                        <small id="id_kriteriaHelp" class="form-text text-muted">Pilih kriteria.</small>
                        @error('id_kriteria')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nama_sub">Nama Sub</label>
                        <input type="text" class="form-control form-control-user @error('nama_sub') is-invalid @enderror" id="nama_sub" placeholder="Masukkan Nama Kriteria"
                            name="nama_sub">
                        <small id="namaHelp" class="form-text text-muted">Berikan nama sub sesuai kriteria yang dipilih.</small>
                        @error('nama_sub')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-6 text-left">
                            <a href="/sub" class="btn btn-dark"><i class="fas fa-arrow-left"></i> Kembali</a>
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