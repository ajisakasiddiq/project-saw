@extends('backend.layouts.app')
@section('title', 'Perhitungan | SPK-AHP')
{{-- @endsection --}}
@section('content')
                <!-- Awal Konten -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Perhitungan Data <a class="btn btn-primary" href="/formulir"><i class="fas fa-external-link-alt"></i> Formulir</a></h1>
                    <p class="mb-4">Pada halaman ini menampilkan data para pendaftar, hanya Admin yang diperbolehkan mengakses halaman ini.</p>
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
                                            <th>Peserta</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Formulir</th>
                                            <th>Tanggal Pembuatan</th>
                                            <th>Jenis</th>
                                            <th>Peserta</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php $no = 1?>
                                        @foreach ($count as $item)
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
                                                <a href="/detail/{{$item->id}}" class="btn btn-sm btn-info m-1"><i class="fas fa-eye"></i>
                                                    <b>Detail</b></a>
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
                                                @if ($item->status != "2")
                                                    <a href="rank/{{ $item->id }}" class="btn btn-sm disabled btn-success m-1 rank"><i class="fas fa-calculator"></i>
                                                    <b>Hitung</b></a>
                                                @else
                                                    <a href="rank/{{ $item->id }}" class="btn btn-sm btn-success m-1 rank"><i class="fas fa-calculator"></i>
                                                    <b>Hitung</b></a>
                                                @endif
                                                {{-- @if ($item->nilai != "")
                                                    <a href="rank/{{ $item->id }}" class="btn btn-sm disabled btn-primary m-1"><i class="fas fa-list"></i>
                                                    <b>Rangking</b></a>
                                                @endif --}}
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