@extends('backend.layouts.app')
@section('title', 'Data Kriteria | SPK-SAW')
{{-- @endsection --}}
@section('content')
                <!-- Awal Konten -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Kriteria</h1>
                    <p class="mb-4">Pada halaman ini menampilkan data kriteria termasuk Halaman Preferensi Bobot AHP, hanya Admin yang diperbolehkan mengakses halaman ini.</p>
                    @include('template.alert')
                    <!-- DataTales Example -->
                    <div class="card shadow d-flex justify mb-4">
                        @if (Auth::user()->role == "Admin")
                        <div class="card-header py-3">
                            <a href="/tambahkt" class="btn btn-primary m-1 btn-icon-text btn-rounded">
                                    <i class="fas fa-plus-circle"></i> Tambah
                                    Kriteria </a>
                            {{-- <a href="/preferensikt" class="btn btn-info m-1 btn-icon-text btn-rounded">
                                    <i class="fa fa-sync"></i> Bobot Preferensi SAW </a> --}}
                        </div>
                        @endif
                        <div class="alert alert-info">
                            Silahkan input data kriteria terlebih dahulu, setelah data kriteria terinput semua, maka nilai bobot akan diberikan berdasarkan perhitungan metode <b>AHP</b> dengan cara mengklik tombol <b>Bobot Preferensi AHP</b>.
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="user" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Kode</th>
                                            <th>Nama Kriteria</th>
                                            <th>Bobot</th>
                                            <th>Jenis</th>
                                            @if (Auth::user()->role == "Admin")
                                            <th>Aksi</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No.</th>
                                            <th>Kode</th>
                                            <th>Nama Kriteria</th>
                                            <th>Bobot</th>
                                            <th>Jenis</th>
                                            @if (Auth::user()->role == "Admin")
                                            <th>Aksi</th>
                                            @endif
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php 
                                            $no = 1;
                                            $nom = 1;
                                            ?>
                                        @foreach ($kriteria as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->kode }}</td>
                                            <td> {{ $item->nama_kriteria }}</td>
                                            <td>
                                                @if (empty($item->bobot))
                                                    Belum di setting
                                                @else
                                                    {{ $item->bobot }}
                                                @endif
                                            </td>
                                            <td>
                                                {{ $item->jenis }}
                                            </td>
                                            @if (Auth::user()->role == "Admin")
                                            <td>
                                                <a href="/editkt/{{$item->id}}" class="btn btn-sm btn-warning m-1"><i class="fas fa-edit"></i>
                                                    <b>Edit</b></a>
                                                <a href="/hapuskt/{{$item->id}}" class="btn btn-sm btn-danger m-1 del"><i class="fas fa-trash-alt"></i>
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