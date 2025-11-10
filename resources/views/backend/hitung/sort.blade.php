@extends('backend.layouts.app')
@section('title', 'Data Ranking Pendaftar | SPK-AHP')
{{-- @endsection --}}
@section('content')
                <!-- Awal Konten -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Ranking {{ $nama_form }}</h1>
                    <p class="mb-4">Tanggal Form Dibuat: {{ date('d/m/Y', strtotime($dibuat)) }}</p>
                    @include('template.alert')
                    <!-- DataTales Example -->
                    <div class="card shadow d-flex justify mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="rank" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Rank.</th>
                                            <th>Nilai</th>
                                            <th>NIM</th>
                                            <th>Nama Mahasiswa</th>
                                            <th>Jurusan</th>
                                            <th>Program Studi</th>
                                            <th>Golongan</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th class="text-center">Rank.</th>
                                            <th>Nilai</th>
                                            <th>NIM</th>
                                            <th>Nama Mahasiswa</th>
                                            <th>Jurusan</th>
                                            <th>Program Studi</th>
                                            <th>Golongan</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php $no = 1;?>
                                        @foreach ($results as $item)
                                        <tr>
                                            <td class="bg-primary text-light text-center">{{ $no++ }}</td>
                                            <td>{{ $item->total_nilai }}</td>
                                            <td>{{ $item->mahasiswa->nim }}</td>
                                            <td>{{ $item->mahasiswa->nama }}</td>
                                            <td>{{ $item->mahasiswa->jurusan->nama_jurusan }}</td>
                                            <td>{{ $item->mahasiswa->prodi->nama_prodi }}</td>
                                            <td>{{ $item->golongan }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Detail Perhitungan -->
                <div class="modal fade" id="modalkuota" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Kuota Penerima Pengajuan {{ $nama_form }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form class="needs-validation" action="/kuota" method="post">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="kuota">Jumlah Kuota Penerima</label>
                                        <input type="number"
                                            required
                                            min="1"
                                            value="{{ count($alternatif) }}"
                                            max="{{ count($alternatif) }}"
                                            class="form-control form-control-user @error('kuota') is-invalid @enderror"
                                            id="kuota"
                                            name="kuota"
                                            placeholder="Masukkan Jumlah Kuota">
                                    </div>
                                    <input type="hidden" name="id_kuota" value="{{ $id_form }}">
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary me-2">
                                        <i class="fas fa-save"></i> Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
@endsection