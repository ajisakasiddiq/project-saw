@extends('backend.layouts.app')
@section('title', 'Data Formulir | SPK-AHP')
{{-- @endsection --}}
@section('content')
                <!-- Awal Konten -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Formulir</h1>
                    <p class="mb-4">Pada halaman ini menampilkan data formulir untuk membuat form pendaftaran untuk mahasiswa, hanya Admin dan Pengelola yang diperbolehkan mengakses halaman ini.</p>
                    @include('template.alert')
                    <!-- DataTales Example -->
                    <div class="card shadow d-flex justify mb-4">
                        @if (Auth::user()->role == "Admin")
                        <div class="card-header py-3">
                            <a href="/tambahfm" class="btn btn-primary btn-icon-text btn-rounded mr-5">
                                    <i class="fas fa-plus-circle"></i> Tambah
                                    Formulir </a>
                        </div>
                        @endif
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="user" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Formulir</th>
                                            <th>Tanggal Pembuatan</th>
                                            <th>Status</th>
                                            @if (Auth::user()->role == "Admin")
                                            <th>Aksi</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Formulir</th>
                                            <th>Tanggal Pembuatan</th>
                                            <th>Status</th>
                                            @if (Auth::user()->role == "Admin")
                                            <th>Aksi</th>
                                            @endif
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php $no = 1?>
                                        @foreach ($form as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->nama_form }}</td>
                                            <td>{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
                                            <td>
                                                @if ($item->status == "0")
                                                    <span class="badge badge-secondary">Tidak Aktif</span>
                                                @elseif ($item->status == "1")
                                                    <span class="badge badge-success">Dibuka</span>
                                                @else
                                                    <span class="badge badge-dark">Ditutup</span>
                                                @endif
                                            </td>
                                            @if (Auth::user()->role == "Admin")
                                            <td>
                                                <a href="/editfm/{{$item->id}}" class="btn btn-sm btn-warning m-1"><i class="fas fa-edit"></i>
                                                    <b>Edit</b></a>
                                                <a href="/hapusfm/{{$item->id}}" class="btn btn-sm btn-danger m-1 del"><i class="fas fa-trash-alt"></i>
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
@endsection