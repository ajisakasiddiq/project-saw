@extends('backend.layouts.app')
@section('title', 'Halaman Pengajuan | SPK-AHP')
{{-- @endsection --}}
@section('content')
<div class="container-fluid grid-margin stretch-card">
    <!-- Judul Halaman -->
        {{-- <div class="align-items-center mb-4"> --}}
            <h1 class="h3 mb-0 text-gray-800">Pendaftaran {{ $form->nama_form}}</h1>
            <p class="mb-4">Pada halaman ini mahasiswa yang akan mendaftarkan pengajuan dapat mengisi form dan upload berkas pendukung.</p>
        {{-- </div> --}}
        <div class="card">
            <div class="card-header border-0">
                <div class="alert alert-primary" role="alert">
                    <h4 class="alert-heading">Nama Mahasiswa: <?= $mhs->nama ?></h4>
                    <p>NIM : <?= $mhs->nim ?></p>
                </div>
            </div>
            @if ($status == '0' || $status == '1')
                <div class="col-md justify-content-center">
                    <div class="row m-3">
                        <div class="col-md-4 text-center mt-4">
                            <img src="{{ url('assets/img/undraw_enter_uhqk.svg')}}" alt="noData" class="img-rounded img-responsive img-fluid" width="50%" oncontextmenu="return false;">
                        </div>
                        <div class="col-md-8 pt-0 mt-4">
                            <h5 class="text-bold text-muted text-left">
                                Mohon maaf, Anda tidak diperbolehkan mendaftar: <br>
                                1. Jika status masih <span class="badge badge-secondary">Pending</span>, anda tidak diperbolehkan mendaftar dalam jangka waktu tersebut. <br>
                                2. Karena Anda sebelumnya sudah pernah mendaftar, dan apabila <span class="badge badge-success">Diterima</span> maka tidak dizinkan mengajukan pendaftaran kembali. <br> 
                                3. Namun apabila pendaftaran sebelumnya <span class="badge badge-danger">Tidak Diterima</span>, silahkan mendaftar kembali.</h5>
                            <a href="/pendaftaran" class="btn btn-secondary mt-3"><i class="fas fa-arrow-left"></i> Kembali</a>
                        </div>
                    </div>
                </div>                
            @else
            <div class="card-body">
                @if (!empty(session('error')))
                    <div class="alert alert-danger text-center" role="alert">
                        <i class="fas fa-ban"></i> {{ session('error') }}
                    </div>
                @endif
                <form class="needs-validation" method="POST" action="/daftarukt" enctype="multipart/form-data">
                    <div class="alert alert-dark" role="alert">
                        Isi data berikut sesuai dengan kondisi anda, pastikan data yang anda inputkan adalah benar.
                    </div>
                    @csrf
                    {{-- {{$kriteria}} --}}
                    @php
                        $no = 1;
                        $nom = 1;
                        $nok = 1;
                    @endphp
                    {{-- @foreach ($kriteria as $key => $k) --}}
                    @for ($i=0; $i < count($kriteria); $i++)
                    @php
                        $index = $i;
                    @endphp
                    <div class="form-group">
                        <label for="kriteria{{ $kriteria[$i]->id }}" class="font-weight-bold">
                            <span class="badge badge-primary">
                                {{ $no++ }}. {{ $kriteria[$i]->nama_kriteria }}
                            </span>
                        </label>

                        <input type="hidden" name="id_kriteria[]" value="{{ $kriteria[$i]->id }}">

                        <input 
                            type="number" 
                            name="nilai_kriteria[]" 
                            id="kriteria{{ $kriteria[$i]->id }}" 
                            class="form-control mt-2 border-primary shadow-sm" 
                            placeholder="Masukkan nilai {{ $kriteria[$i]->nama_kriteria }}" 
                            min="0"
                            step="0.01"
                            required
                        >
                    </div>

                    @endfor
                    <input type="hidden" name="id_form" value="{{$form->id}}">
                    <input type="hidden" name="nim" value="{{$mhs->nim}}">
                    {{-- @endforeach --}}
                    <div class="row mt-5 align-items-center">
                        <div class="col-md-6 col-sm-2 text-left">
                            <a href="/pendaftaran" class="btn btn-dark"><i class="fas fa-arrow-left"></i> Kembali</a>
                        </div>
                        <div class="col-md-6 col-sm-2 text-right">
                            <button type="submit" class="btn btn-primary me-2"><i class="fas fa-save"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
            @endif
        </div>
    </div>
@endsection