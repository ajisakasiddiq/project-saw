@extends('backend.layouts.app')
@section('title', 'Data Kriteria | SPK-AHP')
{{-- @endsection --}}
@section('content')
                <!-- Awal Konten -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Prefensi Bobot Kriteria</h1>
                    <p class="mb-4">Pada halaman ini menampilkan halaman Preferensi Bobot AHP, hanya Admin yang diperbolehkan mengakses halaman ini.</p>
                    @include('template.alert')
                    <!-- DataTales Example -->
                    <div class="card shadow d-flex justify mb-4">
                        <div class="card-header py-3">
                            <a href="/kriteria" class="btn btn-dark m-1 btn-icon-text btn-rounded">
                                    <i class="fas fa-arrow-left"></i> Kembali </a>
                        </div>
                        <div class="alert alert-info">
                            Silahkan isi terlebih dahulu nilai kriteria menggunakan perbandingan berpasangan berdasarkan skala perbandingan 1-9 (sesuai teori) kemudian klik <b>SIMPAN</b>. Setelah itu klik <b>CEK KONSISTENSI</b> untuk melakukan pembobotan preferensi dengan menggunakan metode AHP.
                        </div>
                        <form action="/preferensikt" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="user" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="text-right" width="25%">Nama Kriteria</th>
                                            <th class="text-center" width="50%">Skala Perbandingan</th>
                                            <th class="text-left" width="25%">Nama Kriteria</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $i = 0;
                                        foreach ($kriteria as $row1) :
                                            $ii = 0;
                                            foreach ($kriteria as $row2) :
                                                if ($i < $ii) :
                                                    $nilai = $kriteria_ahp[$row1->id][$row2->id];
                                        ?>
                                                    <tr>
                                                        <td class="text-right">{{$row1->nama_kriteria}}</td>
                                                        <td class="text-center">
                                                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                                <label class="btn btn-info {{ $nilai == -9 ? "active" : "" }}"><input type="radio" id="radio_a_{{ $no }}" name="nilai_{{ $row1->id . '_' . $row2->id }}" value="-9" {{ $nilai == -9 ? "checked" : "" }}>9</label>
                                                                <label class="btn btn-info {{ $nilai == -8 ? "active" : "" }}"><input type="radio" id="radio_b_{{ $no }}" name="nilai_{{ $row1->id . '_' . $row2->id }}" value="-8" {{ $nilai == -8 ? "checked" : "" }}>8</label>
                                                                <label class="btn btn-info {{ $nilai == -7 ? "active" : "" }}"><input type="radio" id="radio_c_{{ $no }}" name="nilai_{{ $row1->id . '_' . $row2->id }}" value="-7" {{ $nilai == -7 ? "checked" : "" }}>7</label>
                                                                <label class="btn btn-info {{ $nilai == -6 ? "active" : "" }}"><input type="radio" id="radio_d_{{ $no }}" name="nilai_{{ $row1->id . '_' . $row2->id }}" value="-6" {{ $nilai == -6 ? "checked" : "" }}>6</label>
                                                                <label class="btn btn-info {{ $nilai == -5 ? "active" : "" }}"><input type="radio" id="radio_e_{{ $no }}" name="nilai_{{ $row1->id . '_' . $row2->id }}" value="-5" {{ $nilai == -5 ? "checked" : "" }}>5</label>
                                                                <label class="btn btn-info {{ $nilai == -4 ? "active" : "" }}"><input type="radio" id="radio_f_{{ $no }}" name="nilai_{{ $row1->id . '_' . $row2->id }}" value="-4" {{ $nilai == -4 ? "checked" : "" }}>4</label>
                                                                <label class="btn btn-info {{ $nilai == -3 ? "active" : "" }}"><input type="radio" id="radio_g_{{ $no }}" name="nilai_{{ $row1->id . '_' . $row2->id }}" value="-3" {{ $nilai == -3 ? "checked" : "" }}>3</label>
                                                                <label class="btn btn-info {{ $nilai == -2 ? "active" : "" }}"><input type="radio" id="radio_h_{{ $no }}" name="nilai_{{ $row1->id . '_' . $row2->id }}" value="-2" {{ $nilai == -2 ? "checked" : "" }}>2</label>
                                                                <label class="btn btn-info {{ $nilai == 1 ? "active" : "" }}"><input type="radio" id="radio_i_{{ $no }}" name="nilai_{{ $row1->id . '_' . $row2->id }}" value="1" {{ $nilai == 1 ? "checked" : "" }}>1</label>
                                                                <label class="btn btn-info {{ $nilai == 2 ? "active" : "" }}"><input type="radio" id="radio_j_{{ $no }}" name="nilai_{{ $row1->id . '_' . $row2->id }}" value="2" {{ $nilai == 2 ? "checked" : "" }}>2</label>
                                                                <label class="btn btn-info {{ $nilai == 3 ? "active" : "" }}"><input type="radio" id="radio_k_{{ $no }}" name="nilai_{{ $row1->id . '_' . $row2->id }}" value="3" {{ $nilai == 3 ? "checked" : "" }}>3</label>
                                                                <label class="btn btn-info {{ $nilai == 4 ? "active" : "" }}"><input type="radio" id="radio_l_{{ $no }}" name="nilai_{{ $row1->id . '_' . $row2->id }}" value="4" {{ $nilai == 4 ? "checked" : "" }}>4</label>
                                                                <label class="btn btn-info {{ $nilai == 5 ? "active" : "" }}"><input type="radio" id="radio_m_{{ $no }}" name="nilai_{{ $row1->id . '_' . $row2->id }}" value="5" {{ $nilai == 5 ? "checked" : "" }}>5</label>
                                                                <label class="btn btn-info {{ $nilai == 6 ? "active" : "" }}"><input type="radio" id="radio_n_{{ $no }}" name="nilai_{{ $row1->id . '_' . $row2->id }}" value="6" {{ $nilai == 6 ? "checked" : "" }}>6</label>
                                                                <label class="btn btn-info {{ $nilai == 7 ? "active" : "" }}"><input type="radio" id="radio_o_{{ $no }}" name="nilai_{{ $row1->id . '_' . $row2->id }}" value="7" {{ $nilai == 7 ? "checked" : "" }}>7</label>
                                                                <label class="btn btn-info {{ $nilai == 8 ? "active" : "" }}"><input type="radio" id="radio_p_{{ $no }}" name="nilai_{{ $row1->id . '_' . $row2->id }}" value="8" {{ $nilai == 8 ? "checked" : "" }}>8</label>
                                                                <label class="btn btn-info {{ $nilai == 9 ? "active" : "" }}"><input type="radio" id="radio_q_{{ $no }}" name="nilai_{{ $row1->id . '_' . $row2->id }}" value="9" {{ $nilai == 9 ? "checked" : "" }}>9</label>
                                                            </div>
                                                        </td>
                                                        <td class="text-left">{{$row2->nama_kriteria}}</td>
                                                    </tr>
                                        <?php
                                                    $no++;
                                                endif;
                                                $ii++;
                                            endforeach;
                                            $i++;
                                        endforeach;
                                        ?>
                                        <tr>
                                            <td class="text-center" colspan="3">
                                                <button type="submit" name="save" class="btn btn-primary"><i class="fas fa-fw fa-save mr-1"></i> Simpan</button>
                                                <button type="submit" name="check" class="btn btn-success"><i class="fas fa-fw fa-check mr-1"></i> Cek Konsistensi</button>
                                                <a href="/resetbkt" class="btn btn-danger res"><i class="fas fa-fw fa-sync mr-1"></i>
                                                    Reset</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        </form>
                    </div>
                    <?php if (isset($_POST['check']) and empty(session('error'))) : ?>
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-info"><i class="fas fa-fw fa-table"></i> Matriks Perbandingan Berpasangan</h6>
                            </div>
                            
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <?= $list_data ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-info"><i class="fas fa-fw fa-table"></i> Matriks Nilai Kriteria (Normalisasi)</h6>
                            </div>
                            
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <?= $list_data2 ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-info"><i class="fas fa-fw fa-table"></i> Matriks Penjumlahan Setiap Baris</h6>
                            </div>
                            
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <?= $list_data3 ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-info"><i class="fas fa-fw fa-table"></i> Perhitungan Rasio Konsistensi</h6>
                            </div>
                            
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <?= $list_data4 ?>
                                    </table>
                                    <?= $list_data5 ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
@endsection