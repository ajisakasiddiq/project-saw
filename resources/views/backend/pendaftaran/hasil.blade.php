@extends('backend.layouts.app')
@section('title', 'Hasil Pengajuan | SPK-AHP')
{{-- @endsection --}}
@section('content')
                <!-- Awal Konten -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Hasil Pengajuan</h1>
                    <p class="mb-4">Pada halaman ini menampilkan data pengajuan yang diajukan Mahasiswa.</p>
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
                                            <th>Tanggal Mendaftar</th>
                                            <th>Jenis</th>
                                            <th>Status</th>
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
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php $no = 1?>
                                        @foreach ($alt as $item)
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
                                                    <span class="badge badge-secondary">Pending</span>
                                                @elseif ($item->status == "1")
                                                    <span class="badge badge-success">Diterima</span>
                                                @else
                                                    <span class="badge badge-danger">Tidak Diterima</span>
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