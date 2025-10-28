@extends('backend.layouts.app')
@section('title', 'Data Pendaftar | SPK-AHP')
{{-- @endsection --}}
@section('content')
                <!-- Awal Konten -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Peserta {{ $nama_form }}</h1>
                    <p class="mb-4">Dibuat: {{ date('d/m/Y', strtotime($dibuat)) }}</p>
                    @include('template.alert')
                    <!-- DataTales Example -->
                    <div class="card shadow d-flex justify mb-4">
                        <div class="card-header py-3">
                            <a href="{{route('hitung')}}" class="btn btn-secondary m-1">
                            <i class="fas fa-arrow-left"></i> Kembali</a>
                        </div>
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
                                            {{-- <th>Aksi</th> --}}
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
                                            {{-- <th>Aksi</th> --}}
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php $no = 1?>
                                        @foreach ($alternatif as $item)
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
                                            {{-- <td>
                                                <button data-toggle="modal" data-target="#modaldetail{{$item->id}}" class="btn btn-sm btn-info m-1"><i class="fas fa-eye"></i>
                                                    <b>Detail</b></button>
                                                <a href="/gagal/{{$item->id}}" class="btn btn-sm btn-danger m-1 del2"><i class="fas fa-trash-alt"></i>
                                                    <b>Hapus</b></a>
                                            </td> --}}
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                @foreach ($alternatif as $i)
                <!-- Modal Tambah Import -->
                <div class="modal fade" id="modaldetail{{$i->id}}" tabindex="-1">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Detail Mahasiswa Pendaftar {{ $i->id }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
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
                        </div>
                    </div>
                </div>
            @endforeach
@endsection