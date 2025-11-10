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
                                            @php
                                                $cek_form = $cek->get($item->id);
                                            @endphp
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
                                                {{-- ✅ Jika ada alternatif dan status_alternatif = 2 --}}
                                                @if (!empty($item->status_alternatif) && $item->status_alternatif == 2)
                                                    <span class="badge badge-danger">Dokumen Ditolak</span> <br>
                                                    <p>{{ $item->description_alternatif }}</p>
                                                    <button data-toggle="modal" data-target="#modaldetail{{$item->id_alternatif}}" class="btn btn-sm btn-info m-1"><i class="fas fa-eye"></i>
                                                    <b>Upload</b></button>
                                                   
                                                

                                                {{-- ✅ Jika tidak ada alternatif → jalankan logic default --}}
                                                @elseif (empty($item->status_alternatif))

                                                    @if ($item->status == '2' && empty($cek_form))
                                                        <a href="#" class="btn btn-sm btn-info m-1 disabled">
                                                            <i class="fas fa-edit"></i> <b>Detail</b>
                                                        </a>

                                                    @elseif ($item->status == '1' && empty($cek_form))
                                                        <a href="/detail_/{{ $item->id }}" class="btn btn-sm btn-info m-1">
                                                            <i class="fas fa-edit"></i> <b>Detail</b>
                                                        </a>

                                                    @elseif ($item->status == '1' && !empty($cek_form))
                                                        @if ($cek_form->id_form == $item->id)
                                                            <span class="badge badge-info">Terdaftar</span>
                                                        @else
                                                            <a href="/detail_/{{ $item->id }}" class="btn btn-sm btn-info m-1">
                                                                <i class="fas fa-edit"></i> <b>Detail</b>
                                                            </a>
                                                        @endif

                                                    @elseif ($item->status == '2' && !empty($cek_form))
                                                        @if ($cek_form->id_form == $item->id)
                                                            <span class="badge badge-info">Terdaftar</span>
                                                        @else
                                                            <a href="#" class="btn btn-sm btn-info m-1 disabled">
                                                                <i class="fas fa-edit"></i> <b>Detail</b>
                                                            </a>
                                                        @endif
                                                    @endif


                                                {{-- ✅ Jika ada alternatif tapi status_alternatif BUKAN 2 → jalankan logic default --}}
                                                @else

                                                    @if ($item->status == '2' && empty($cek_form))
                                                        <a href="#" class="btn btn-sm btn-info m-1 disabled">
                                                            <i class="fas fa-edit"></i> <b>Detail</b>
                                                        </a>

                                                    @elseif ($item->status == '1' && empty($cek_form))
                                                        <a href="/detail_/{{ $item->id }}" class="btn btn-sm btn-info m-1">
                                                            <i class="fas fa-edit"></i> <b>Detail</b>
                                                        </a>

                                                    @elseif ($item->status == '1' && !empty($cek_form))
                                                        @if ($cek_form->id_form == $item->id)
                                                            <span class="badge badge-info">Terdaftar</span>
                                                        @else
                                                            <a href="/detail_/{{ $item->id }}" class="btn btn-sm btn-info m-1">
                                                                <i class="fas fa-edit"></i> <b>Detail</b>
                                                            </a>
                                                        @endif

                                                    @elseif ($item->status == '2' && !empty($cek_form))
                                                        @if ($cek_form->id_form == $item->id)
                                                            <span class="badge badge-info">Terdaftar</span>
                                                        @else
                                                            <a href="#" class="btn btn-sm btn-info m-1 disabled">
                                                                <i class="fas fa-edit"></i> <b>Detail</b>
                                                            </a>
                                                        @endif
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
                @foreach ($form as $i)
                <!-- Modal Tambah Import -->
                <div class="modal fade" id="modaldetail{{$i->id_alternatif}}" tabindex="-1">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <form method="POST" action="/pendaftaran/{{$i->id_alternatif}}/update" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $i->id_alternatif }}">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Upload Ulang Dokumen</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="mb-2 rounded alert alert-dark"><i class="fas fa-info-circle"></i> Upload Dokumen Sesuai Ketentuan.</p>
                                        <div class="form-group mb-3">
                                            <label for="file">Upload</label>
                                            <div class="custom-file">
                                                 <input type="file" class="custom-file-input" name="file" id="file01" required accept="application/pdf" aria-describedby="file01">
                                                <label class="custom-file-label" for="file">Choose file</label>
                                            </div>
                                            <small class="form-text text-success">Unggah file pdf.</small>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Simpan</button>
                                    </div>
                             </form>
                             <script>
                                $('.custom-file-input').on('change', function() {
                                    let fileName = $(this).val().split("\\").pop();
                                    $(this).next('.custom-file-label').addClass("selected").html(fileName);
                                });
                            </script>

                        </div>
                    </div>
                </div>
            @endforeach
@endsection