@extends('backend.layouts.app')
@section('title', 'Data Pendaftar | SPK-AHP')
{{-- @endsection --}}
@section('content')
                <!-- Awal Konten -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Peserta {{ $nama_form }}</h1>
                    <p class="mb-4">Dibuat: {{ date('d/m/Y', strtotime($dibuat)) }}</p>
                    @include('template.alert')
                    <!-- DataTales Example -->
                    <div class="card shadow d-flex justify mb-4">
                        <div class="card-header py-3">
                            <a href="{{route('hitung')}}" class="btn btn-secondary m-1">
                            <i class="fas fa-arrow-left"></i> Kembali</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="mhs" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>NIM</th>
                                            <th>Nama Mahasiswa</th>
                                            <th>Jurusan</th>
                                            <th>Program Studi</th>
                                            {{-- <th>Angkatan</th> --}}
                                            <th>Semester</th>
                                            <th>Jalur Masuk</th>
                                            <th>UKT</th>
                                            <th>Ponsel</th>
                                            <th>Alamat</th>
                                            <th>Status</th>
                                            <th>Dokumen</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No.</th>
                                            <th>NIM</th>
                                            <th>Nama Mahasiswa</th>
                                            <th>Jurusan</th>
                                            <th>Program Studi</th>
                                            {{-- <th>Angkatan</th> --}}
                                            <th>Semester</th>
                                            <th>Jalur Masuk</th>
                                            <th>UKT</th>
                                            <th>Ponsel</th>
                                            <th>Alamat</th>
                                            <th>Status</th>
                                            <th>Dokumen</th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php $no = 1?>
                                        @foreach ($alternatif as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->nim }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->nama_jurusan }}</td>
                                            <td>{{ $item->nama_prodi }}</td>
                                            {{-- <td>{{ $item->angkatan }}</td>
                                            <td>{{ $item->semester }}</td>
                                            <td>{{ $item->jalur_masuk }}</td>
                                            <td>{{ $item->ukt_sekarang}}</td>
                                            <td>{{ $item->ponsel }}</td>
                                            <td>{{ $item->alamat }}</td> --}}
                                            <td>
                                                @if ($item->status_alternatif == 0)
                                                    <span class="badge bg-warning text-dark">Pending</span>
                                                @elseif ($item->status_alternatif == 1)
                                                    <span class="badge bg-success">Diterima</span>
                                                @elseif ($item->status_alternatif == 2)
                                                    <span class="badge bg-danger">Ditolak</span>
                                                @endif
                                            </td>

                                            <td>
                                                <a href="{{ route('pdf.download', ['id_mahasiswa' => $item->id_mahasiswa, 'id_form' => $item->id_form]) }}"
                                                    class="btn btn-sm btn-info m-1">
                                                    <i class="fas fa-download"></i> <b>View</b>
                                                </a>
                                            </td>
                                           <td>
                                                <button data-toggle="modal" data-target="#modaldetail{{$item->id}}" 
                                                        class="btn btn-sm btn-warning m-1">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                @foreach ($alternatif as $item)
                <!-- Modal Tambah Import -->
                <div class="modal fade" id="modaldetail{{$item->id}}" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <form method="POST" action="/detail/{{$item->id}}/update">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Update Status - {{ $item->nama }}</h5>
                                    <button type="button" class="close" data-dismiss="modal">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <input type="hidden" name="id" value="{{ $item->id_alternatif }}">

                                <div class="modal-body">

                                    <!-- Select Status -->
                                    <div class="form-group mb-3">
                                        <label>Status</label>
                                        <select class="form-control" name="status" id="statusSelect{{$item->id}}">
                                            <option value="0" {{ $item->status_alternatif == 0 ? 'selected' : '' }}>Pending</option>
                                            <option value="1" {{ $item->status_alternatif == 1 ? 'selected' : '' }}>Diterima</option>
                                            <option value="2" {{ $item->status_alternatif == 2 ? 'selected' : '' }}>Ditolak</option>
                                        </select>
                                    </div>

                                    <!-- Alasan (tampil hanya jika status=2) -->
                                    <div class="form-group mb-3" id="alasanBox{{$item->id}}" 
                                        style="display: {{ $item->status_alternatif == 2 ? 'block' : 'none' }};">
                                        <label>Alasan Penolakan</label>
                                        <textarea class="form-control" name="description" rows="3">{{ $item->alasan }}</textarea>
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Simpan</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>

            @endforeach
            <script>
                $(document).ready(function () {
                    @foreach ($alternatif as $i)
                        $('#statusSelect{{$i->id}}').on('change', function () {
                            if ($(this).val() == '2') {
                                $('#alasanBox{{$i->id}}').show();
                            } else {
                                $('#alasanBox{{$i->id}}').hide();
                            }
                        });
                    @endforeach
                });
        </script>

@endsection