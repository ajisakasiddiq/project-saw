@extends('backend.layouts.app')
@section('title', 'List Ranking | SPK-AHP')
{{-- @endsection --}}
@section('content')
                <!-- Awal Konten -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Hasil Ranking</h1>
                    <p class="mb-4">Pada halaman ini menampilkan hasil rangking berdasarkan formulir, hanya Admin dan Pengelola yang diperbolehkan mengakses halaman ini.</p>
                    @include('template.alert')
                    <!-- DataTales Example -->
                    <div class="card shadow d-flex justify mb-4">
                        {{-- <div class="card-header py-3">
                            <a href="/tambahfm" class="btn btn-primary btn-icon-text btn-rounded mr-5">
                                    <i class="fas fa-plus-circle"></i> Tambah
                                    Formulir </a>
                        </div> --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="user" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Formulir</th>
                                            <th>Tanggal Pembuatan</th>
                                            <th>Jenis</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Formulir</th>
                                            <th>Tanggal Pembuatan</th>
                                            <th>Jenis</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php $no = 1?>
                                        @foreach ($rank as $item)
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
                                                <a href="list/detail/{{ $item->id }}" class="btn btn-sm btn-success m-1"><i class="fas fa-list"></i>
                                                <b>Detail</b></a>
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