@extends('backend.layouts.app')
@section('title', 'Data User | SPK-AHP')
{{-- @endsection --}}
@section('content')
                <!-- Awal Konten -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">User</h1>
                    <p class="mb-4">Pada halaman ini menampilkan data user termasuk Mahasiswa dan Pengelola, hanya Admin yang diperbolehkan mengakses halaman ini.</p>
                    @include('template.alert')
                    <!-- DataTales Example -->
                    <div class="card shadow d-flex justify mb-4">
                        <div class="card-header py-3">
                            <a href="/tambahuc" class="btn btn-primary btn-icon-text btn-rounded mr-5">
                                    <i class="fas fa-plus-circle"></i> Tambah
                                    User </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="user" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama User</th>
                                            <th>Email</th>
                                            <th>Foto</th>
                                            <th>Akses</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama User</th>
                                            <th>Email</th>
                                            <th>Foto</th>
                                            <th>Akses</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php $no = 1?>
                                        @foreach ($user as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>
                                                <img src="{{ url('picture/accounts/'. $item->foto)}}" style="width: 80px" class="img-thumbnail" alt="gambar-user">
                                                <br>{{ $item->foto }}</td>
                                            <td>
                                                @if ($item->role == 'Admin')
                                                    <span class="badge badge-primary">Admin</span>
                                                @elseif ($item->role == 'Pengelola')
                                                    <span class="badge badge-info">Pengelola</span>
                                                @else
                                                    <span class="badge badge-dark">Mahasiswa</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->email_verified_at == null)
                                                    <span class="badge badge-secondary">Belum Aktif</span>
                                                @else
                                                    <span class="badge badge-success">Aktif</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="/edituc/{{$item->id}}" class="btn btn-sm btn-warning m-1"><i class="fas fa-edit"></i>
                                                    <b>Edit</b></a>
                                                <a href="/hapusuc/{{$item->id}}" class="btn btn-sm btn-danger m-1 del"><i class="fas fa-trash-alt"></i>
                                                    <b>Hapus</b></a>
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