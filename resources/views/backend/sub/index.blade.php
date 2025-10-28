@extends('backend.layouts.app')
@section('title', 'Data Sub Kriteria | SPK-AHP')
{{-- @endsection --}}
@section('content')
                <!-- Awal Konten -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Sub-Kriteria</h1>
                    <p class="mb-4">Pada halaman ini menampilkan data Sub-kriteria termasuk Halaman Preferensi Bobot AHP, hanya Admin yang diperbolehkan mengakses halaman ini.</p>
                    @include('template.alert')
                    <!-- DataTales Example -->
                    <div class="card shadow d-flex justify mb-4">
                        @if (Auth::user()->role == "Admin")
                        <div class="card-header py-3">
                            <a href="/tambahsb" class="btn btn-primary m-1 btn-icon-text btn-rounded">
                                    <i class="fas fa-plus-circle"></i> Tambah
                                    Sub-Kriteria </a>
                            <a href="#" data-toggle="modal" data-target="#subAHP" class="btn btn-info m-1 btn-icon-text btn-rounded">
                                    <i class="fa fa-sync"></i> Bobot Preferensi AHP </a>
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
                                            <th>Nama Kriteria</th>
                                            <th>Nama Sub</th>
                                            <th>Bobot</th>
                                            @if (Auth::user()->role == "Admin")
                                            <th>Aksi</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Kriteria</th>
                                            <th>Nama Sub</th>
                                            <th>Bobot</th>
                                            @if (Auth::user()->role == "Admin")
                                            <th>Aksi</th>
                                            @endif
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php $no = 1?>
                                        @foreach ($sub as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->nama_kriteria }}</td>
                                            <td>{{ $item->nama_sub }}</td>
                                            <td>
                                                @if (empty($item->bobot))
                                                    Belum di setting
                                                @else
                                                    {{ $item->bobot }}
                                                @endif
                                            </td>
                                            @if (Auth::user()->role == "Admin")
                                            <td>
                                                <a href="/editsb/{{$item->id}}" class="btn btn-sm btn-warning m-1"><i class="fas fa-edit"></i>
                                                    <b>Edit</b></a>
                                                <a href="/hapussb/{{$item->id}}" class="btn btn-sm btn-danger m-1 del"><i class="fas fa-trash-alt"></i>
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

                    <!-- Logout Modal-->
                    <div class="modal fade" id="subAHP" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Pilih Kriteria</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @foreach ($kriteria as $i)
                                    <a class="btn btn-sm btn-info m-1" href="/preferensisb/{{ $i->id }}">{{ $i->nama_kriteria }}</a><br>
                                    @endforeach
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                </div>
                            </div>
                        </div>
                    </div>
@endsection