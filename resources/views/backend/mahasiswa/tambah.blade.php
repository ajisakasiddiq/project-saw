@extends('backend.layouts.app')
@section('title', 'Tambah Mahasiswa | SPK-AHP')
{{-- @endsection --}}
@section('content')
<div class="container-fluid grid-margin stretch-card">
    <!-- Judul Halaman -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tambah Mahasiswa</h1>
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
                <form class="needs-validation" method="POST" action="/tambahmh">
                    @csrf
                    <div class="form-group">
                        <label for="nim">NIM atau Nomer Induk Mahasiswa</label>
                        <input type="text" class="form-control form-control-user @error('nim') is-invalid @enderror" value="{{old('nim')}}" id="nim" placeholder="Masukkan NIM"
                            name="nim">
                        <small id="nimHelp" class="form-text text-muted">Contoh: E41181223.</small>
                        @error('nim')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Mahasiswa</label>
                        <input type="text" class="form-control form-control-user @error('nama') is-invalid @enderror" value="{{old('nama')}}" id="nama" placeholder="Masukkan Nama"
                            name="nama">
                        <small id="namaHelp" class="form-text text-muted">Contoh: Budi Susanto.</small>
                        @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="jurusan">Jurusan</label>
                        <select class="custom-select @error('jurusan') is-invalid @enderror" name="jurusan" id="jurusan">
                            <option value="">-- Pilih Jurusan --</option>
                            @foreach ($jur as $j)
                                <option value="{{ $j->id }}">{{ $j->nama_jurusan }}</option>
                            @endforeach
                        </select>
                        <small id="jurusanHelp" class="form-text text-muted">Pilih jurusan mahasiswa.</small>
                        @error('jurusan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="program_studi">Program Studi</label>
                        <select class="custom-select @error('program_studi') is-invalid @enderror" name="prodi" id="prodi">
                        </select>
                        <small id="program_studiHelp" class="form-text text-muted">Pilih program studi mahasiswa.</small>
                        @error('program_studi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="angkatan">Angkatan</label>
                        <input type="number" class="form-control form-control-user @error('angkatan') is-invalid @enderror" value="{{old('angkatan')}}" id="angkatan" placeholder="Masukkan Tahun Angkatan"
                        name="angkatan" min="1900" max="2099" step="1">
                        <small id="angkatanHelp" class="form-text text-muted">Masukkan tahun angkatan.</small>
                        @error('angkatan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <input type="number" class="form-control form-control-user @error('semester') is-invalid @enderror" value="{{old('semester')}}" id="semester" placeholder="Masukkan Semester"
                        name="semester" min="1">
                        <small id="semesterHelp" class="form-text text-muted">Masukkan semester mahasiswa.</small>
                        @error('semester')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="jalur_masuk">Jalur Masuk</label>
                        <select class="custom-select @error('jalur_masuk') is-invalid @enderror" name="jalur_masuk" value="{{old('jalur_masuk')}}" id="jalur_masuk">
                            <option value="">-- Pilih Jalur Masuk --</option>
                            <option value="SNBP">SNBP</option>
                            <option value="UTBK-SNBT">UTBK-SNBT</option>
                            <option value="MANDIRI PMDK-PA">MANDIRI PMDK-PA</option>
                            <option value="MANDIRI">MANDIRI</option>
                            <option value="ALIH JENJANG">ALIH JENJANG</option>
                            <option value="PASCASARJANA">PASCASARJANA</option>
                        </select>
                        <small id="jalur_masukHelp" class="form-text text-muted">Pilih jalur masuk.</small>
                        @error('jalur_masuk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="ukt">UKT Sekarang</label>
                        <input type="text" class="form-control form-control-user @error('ukt') is-invalid @enderror" value="{{old('ukt')}}" id="ukt" placeholder="Masukkan UKT Saat Ini"
                        name="ukt">
                        <small id="uktHelp" class="form-text text-muted">Masukkan ukt mahasiswa.</small>
                        @error('ukt')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="ponsel">No. Ponsel</label>
                        <input type="number" class="form-control form-control-user @error('ponsel') is-invalid @enderror" value="{{old('ponsel')}}" id="ponsel" placeholder="Masukkan No. Ponsel"
                        name="ponsel">
                        <small id="ponselHelp" class="form-text text-muted">Masukkan no. ponsel mahasiswa.</small>
                        @error('ponsel')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat Lengkap</label>
                        <textarea class="form-control form-control-user @error('alamat') is-invalid @enderror" id="alamat" placeholder="Masukkan Alamat lengkap"
                        name="alamat">{{old('alamat')}}</textarea>
                        <small id="alamatHelp" class="form-text text-muted">Masukkan alamat lengkap mahasiswa.</small>
                        @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-6 text-left">
                            <a href="/mahasiswa" class="btn btn-dark"><i class="fas fa-arrow-left"></i> Kembali</a>
                        </div>
                        <div class="col-md-6 text-right">
                            <button type="submit" class="btn btn-primary me-2"><i class="fas fa-save"></i> Tambah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<script>
    $(function (){
        $('#jurusan').on('change', function(){
            let id_jurusan = $('#jurusan').val();

            // console.log(id_jurusan);
            $.ajax({
                type : 'POST',
                url : "{{route('getprodi')}}",
                data : {
                    "_token": "{{ csrf_token() }}", 
                    id_jurusan: id_jurusan
                },
                cache : false,

                success: function(msg){
                    $('#prodi').html(msg)
                },
                error: function(data)
                {
                    console.log('error:', data)
                }
            })
        })
    });
</script>
@endsection