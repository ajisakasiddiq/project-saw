@extends('backend.layouts.app')
@section('title', 'Data List Pengajuan | SPK-AHP')
{{-- @endsection --}}
@section('content')
                <!-- Awal Konten -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Pendaftaran</h1>
                    <p class="mb-4">Pada halaman ini menampilkan data formulir untuk Mahasiswa yang ingin mendaftar.</p>
                    @include('template.alert')
                    <!-- DataTales Example -->
                    <div class="card shadow d-flex justify mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="user" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Formulir</th>
                                            <th>Tanggal Pembuatan</th>
                                            {{-- <th>Kuota</th> --}}
                                            <th>Jenis</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Formulir</th>
                                            <th>Tanggal Pembuatan</th>
                                            {{-- <th>Kuota</th> --}}
                                            <th>Jenis</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
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
                                                @if ($item->jenis == 'Pengangsuran UKT')
                                                    <span class="badge badge-primary">Pengangsuran UKT</span>
                                                @else
                                                    <span class="badge badge-info">Penurunan UKT</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->status == "0")
                                                    <span class="badge badge-secondary">Tidak Aktif</span>
                                                @elseif ($item->status == "1")
                                                    <span class="badge badge-success">Dibuka</span>
                                                @else
                                                    <span class="badge badge-dark">Ditutup</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->status == '2' && empty($cek->id_form))
                                                <a href="#" class="btn btn-sm btn-info m-1 disabled"><i class="fas fa-edit"></i>
                                                <b>Detail</b></a>
                                                @elseif ($item->status == '1' && empty($cek->id_form))
                                                    <a href="/detail_/{{$item->id}}" class="btn btn-sm btn-info m-1"><i class="fas fa-edit"></i>
                                                    <b>Detail</b></a>
                                                @elseif ($item->status == '1' && !empty($cek->id_form))
                                                    @if($cek->id_form == $item->id)
                                                        <span class="badge badge-info">Terdaftar</span>
                                                    @elseif($cek->id_form != $item->id)
                                                        <a href="/detail_/{{$item->id}}" class="btn btn-sm btn-info m-1"><i class="fas fa-edit"></i>
                                                        <b>Detail</b></a>
                                                    @endif
                                                @elseif ($item->status == '2' && !empty($cek->id_form))
                                                    @if($cek->id_form == $item->id)
                                                        <span class="badge badge-info">Terdaftar</span>
                                                    @elseif($cek->id_form != $item->id)
                                                        <a href="#" class="btn btn-sm btn-info m-1 disabled"><i class="fas fa-edit"></i>
                                                        <b>Detail</b></a>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
@endsection