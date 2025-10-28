@extends('backend.layouts.app')
@section('title', 'Data Lengkap Pengajuan '. $nama_form .' | SPK-AHP')
{{-- @endsection --}}
@section('content')
                <!-- Awal Konten -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Penerima {{ $nama_form }}</h1>
                    <p class="mb-4">Tanggal Form Dibuat: {{ date('d/m/Y', strtotime($dibuat)) }}</p>
                    @include('template.alert')
                    <!-- DataTales Example -->
                    <div class="card shadow d-flex justify mb-4">
                        <div class="card-header py-3">
                            <a href="{{route('hasil')}}" class="btn btn-secondary m-1">
                            <i class="fas fa-arrow-left"></i> Kembali</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="final" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Status</th>
                                            <th>NIM</th>
                                            <th>Nama Mahasiswa</th>
                                            <th>Jurusan</th>
                                            <th>Program Studi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No.</th>
                                            <th>Status</th>
                                            <th>NIM</th>
                                            <th>Nama Mahasiswa</th>
                                            <th>Jurusan</th>
                                            <th>Program Studi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php $no = 1;?>
                                        @foreach ($results as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>
                                                @if ($item->status == "0")
                                                    <span class="badge badge-secondary">Pending</span>
                                                @elseif ($item->status == "1")
                                                    <span class="badge badge-success">Diterima</span>
                                                @else
                                                    <span class="badge badge-danger">Tidak Diterima</span>
                                                @endif
                                            </td>
                                            <td>{{ $item->mahasiswa->nim }}</td>
                                            <td>{{ $item->mahasiswa->nama }}</td>
                                            <td>{{ $item->mahasiswa->jurusan->nama_jurusan }}</td>
                                            <td>{{ $item->mahasiswa->prodi->nama_prodi }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
@endsection