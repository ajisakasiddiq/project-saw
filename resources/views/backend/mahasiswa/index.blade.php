@extends('backend.layouts.app')
@section('title', 'Data Mahasiswa | SPK-AHP')
{{-- @endsection --}}
@section('content')
                <!-- Awal Konten -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Mahasiswa</h1>
                    <p class="mb-4">Pada halaman ini menampilkan data mahasiswa, hanya Admin yang diperbolehkan mengakses halaman ini.</p>
                    @include('template.alert')
                    <!-- DataTales Example -->
                    <div class="card shadow d-flex justify mb-4">
                        @if (Auth::user()->role == "Admin")
                        <div class="card-header py-3">
                            <a href="/tambahmh" class="btn btn-primary btn-icon-text btn-rounded m-1">
                                    <i class="fas fa-plus-circle"></i> Tambah
                                    Mahasiswa </a>
                            <button class="btn btn-success btn-icon-text btn-rounded m-1" data-toggle="modal" data-target="#modalImport">
                                    <i class="fas fa-file-excel"></i> Tambah Data Excel</button>
                        </div>
                        @endif
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="mhs" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>NIM</th>
                                            <th>Nama Mahasiswa</th>
                                            <th>Jurusan</th>
                                            <th>Program Studi</th>
                                            <th>Angkatan</th>
                                            <th>Semester</th>
                                            <th>Jalur Masuk</th>
                                            <th>UKT</th>
                                            <th>Ponsel</th>
                                            <th>Alamat</th>
                                            @if (Auth::user()->role == "Admin")
                                            <th>Aksi</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No.</th>
                                            <th>NIM</th>
                                            <th>Nama Mahasiswa</th>
                                            <th>Jurusan</th>
                                            <th>Program Studi</th>
                                            <th>Angkatan</th>
                                            <th>Semester</th>
                                            <th>Jalur Masuk</th>
                                            <th>UKT</th>
                                            <th>Ponsel</th>
                                            <th>Alamat</th>
                                            @if (Auth::user()->role == "Admin")
                                            <th>Aksi</th>
                                            @endif
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php $no = 1?>
                                        @foreach ($mhs as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->nim }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->nama_jurusan }}</td>
                                            <td>{{ $item->nama_prodi }}</td>
                                            <td>{{ $item->angkatan }}</td>
                                            <td>{{ $item->semester }}</td>
                                            <td>{{ $item->jalur_masuk }}</td>
                                            <td>{{ $item->ukt_sekarang}}</td>
                                            <td>{{ $item->ponsel }}</td>
                                            <td>{{ $item->alamat }}</td>
                                            @if (Auth::user()->role == "Admin")
                                            <td>
                                                <a href="/editmh/{{$item->id}}" class="btn btn-sm btn-warning m-1"><i class="fas fa-edit"></i>
                                                    <b>Edit</b></a>
                                                <a href="/hapusmh/{{$item->id}}" class="btn btn-sm btn-danger m-1 del"><i class="fas fa-trash-alt"></i>
                                                    <b>Hapus</b></a>
                                            </td>
                                            @endif
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Modal Tambah Import -->
                <div class="modal fade" id="modalImport" tabindex="-1">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Data Mahasiswa</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="/importmhs" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <p class="mb-2 rounded alert alert-dark"><i class="fas fa-info-circle"></i> Import digunakan untuk menambahkan lebih dari satu file berformat EXCEL (.xlx atau .xlsx).</p>
                                    <div class="form-group mb-3">
                                        <label for="file">File Import</label>
                                        <div class="custom-file">
                                            <input type="file" name="file" class="custom-file-input" id="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                            <label class="custom-file-label" for="file">Unggah file</label>
                                        </div>
                                        <small class="form-text text-success">Unggah file excel. *maximal ukuran 5mb</small>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
@endsection