<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Sub;
use App\Models\SubAhp;
use Illuminate\Support\Facades\Session;

class SubController extends Controller
{
    public function index()
    {
        $data['sub'] = DB::table('sub')
            ->join('kriteria', 'sub.id_kriteria', '=', 'kriteria.id')
            ->select('kriteria.*', 'sub.*')
            // ->groupBy('sub.id_kriteria')
            // ->orderBy('sub.id_kriteria', 'ASC')
            ->orderBy('kriteria.bobot', 'DESC')
            ->orderBy('sub.bobot', 'DESC')
            ->get();
        $data['kriteria'] = DB::table('kriteria')->orderByDesc('bobot')->get();
        return view('backend.sub.index', $data);
    }

    public function tambah()
    {
        $data['kriteria'] = DB::table('kriteria')->orderByDesc('bobot')->get();
        return view('backend.sub.tambah', $data);
    }

    function create(Request $request)
    {

        $request->validate([
            'id_kriteria' => 'required',
            'nama_sub' => 'required|unique:sub'
        ], [
            'id_kriteria.required' => 'Kriteria wajib diisi',
            'nama_sub.required' => 'Nama wajib diisi',
            'nama_sub.unique' => 'Nama sub kriteria sudah ada, harap menggunakan nama lain',
        ]);

        $save = new Sub();
        $save->id_kriteria = trim($request->id_kriteria);
        $save->nama_sub = trim($request->nama_sub);
        $save->save();

        return redirect()->route('sub')->with(['success' => 'Tambah Sub-Kriteria Berhasil!']);
    }

    public function edit($id)
    {
        $data = Sub::where('id', $id)->get();
        $kt['kriteria'] = DB::table('kriteria')->get();
        return view('backend.sub.edit', ['sb' => $data], $kt);
    }

    function update(Request $request)
    {

        $request->validate([
            'id_kriteria' => 'required',
            'nama_sub' => 'required',
        ], [
            'id_kriteria.required' => 'Kriteria wajib diisi',
            'nama_sub.required' => 'Nama wajib diisi'
        ]);

        $sub = Sub::find($request->id);

        $sub->id_kriteria = $request->id_kriteria;
        $sub->nama_sub = $request->nama_sub;
        $sub->save();

        return redirect()->route('sub')->with(['success' => 'Edit Sub-Kriteria Berhasil!']);
    }

    function hapus($id)
    {
        DB::table('kriteria')->where('id', $id)->delete();

        return redirect()->route('sub')->with(['success' => 'Hapus Berhasil!']);
    }

    function preferensi($id)
    {
        $data['sub'] = Sub::where('id_kriteria', $id)->get();
        $data['id'] = $id;

        $result = array();
        $i = 0;
        foreach ($data['sub'] as $row1) {
            $ii = 0;
            foreach ($data['sub'] as $row2) {
                if ($i < $ii) {
                    // $kriteria_ahp = $this->Kriteria_ahp_model->get_kriteria_ahp($row1->id_kriteria, $row2->id_kriteria)->row();
                    $sub_ahp =
                        DB::table('sub_ahps')
                        ->where('id_sub1', '=', $row1->id)
                        ->where('id_sub2', '=', $row2->id)
                        ->first();
                    if (empty($sub_ahp)) {
                        $ahp = new SubAhp();
                        $ahp->id_sub1 = $row1->id;
                        $ahp->id_sub2 = $row2->id;
                        $ahp->nilai1 = 1;
                        $ahp->nilai2 = 1;
                        $ahp->save();
                        $nilai_1 = 1;
                        $nilai_2 = 1;
                    } else {
                        $nilai_1 = $sub_ahp->nilai1;
                        $nilai_2 = $sub_ahp->nilai2;
                    }
                    $nilai = 0;
                    if ($nilai_1 < 1) {
                        $nilai = $nilai_2;
                    } elseif ($nilai_1 > 1) {
                        $nilai = -$nilai_1;
                    } elseif ($nilai_1 == 1) {
                        $nilai = 1;
                    }
                    $result[$row1->id][$row2->id] = $nilai;
                }
                $ii++;
            }
            $i++;
        }

        $data['sub_ahp'] = $result;
        return view('backend.sub.preferensi', $data);
    }

    function bobot(Request $request, $id)
    {
        $data['sub'] = Sub::where('id_kriteria', $id)->get();

        if (isset($_POST['save'])) {
            // SubAhp::truncate();
            $i = 0;
            foreach ($data['sub'] as $row1) {
                $ii = 0;
                foreach ($data['sub'] as $row2) {
                    $sub_ahp =
                        DB::table('sub_ahps')
                        ->where('id_sub1', '=', $row1->id)
                        ->where('id_sub2', '=', $row2->id)
                        ->first();
                    if ($i < $ii) {
                        $nilai_input = $request->post('nilai_' . $row1->id . '_' . $row2->id);
                        $nilai_1 = 0;
                        $nilai_2 = 0;
                        if ($nilai_input < 1) {
                            $nilai_1 = abs($nilai_input);
                            $nilai_2 = number_format(1 / abs($nilai_input), 5);
                        } elseif ($nilai_input > 1) {
                            $nilai_1 = number_format(1 / abs($nilai_input), 5);
                            $nilai_2 = abs($nilai_input);
                        } elseif ($nilai_input == 1) {
                            $nilai_1 = 1;
                            $nilai_2 = 1;
                        }

                        $sub = SubAhp::findOrFail($sub_ahp->id);

                        if (empty($sub_ahp)) {
                            SubAhp::insert([
                                'id_sub1' => $row1->id,
                                'id_sub2' => $row2->id,
                                'nilai1' => $nilai_1,
                                'nilai2' => $nilai_2,
                            ]);
                        } else {
                            $sub->update([
                                'nilai1' => $nilai_1,
                                'nilai2' => $nilai_2,
                            ]);
                        }
                    }
                    $ii++;
                }
                $i++;
            }
            return redirect()->back()->with(['success' => 'Nilai perbandingan sub kriteria berhasil disimpan!']);
        }

        if (isset($_POST['check'])) {
            if (count($data['sub']) < 3) {
                return redirect()->back()->with(['error' => 'Jumlah sub kriteria kurang, minimal 3!']);
            } else {
                $id_sub = array();
                foreach ($data['sub'] as $row)
                    $id_sub[] = $row->id;
            }

            // perhitungan metode AHP
            $matrik_kriteria = $this->ahp_get_matrik_kriteria($id_sub);
            $jumlah_kolom = $this->ahp_get_jumlah_kolom($matrik_kriteria);
            $matrik_normalisasi = $this->ahp_get_normalisasi($matrik_kriteria, $jumlah_kolom);
            $prioritas = $this->ahp_get_prioritas($matrik_normalisasi);
            $matrik_baris = $this->ahp_get_matrik_baris($prioritas, $matrik_kriteria);
            $jumlah_matrik_baris = $this->ahp_get_jumlah_matrik_baris($matrik_baris);
            $hasil_tabel_konsistensi = $this->ahp_get_tabel_konsistensi($jumlah_matrik_baris, $prioritas);

            $n = count($jumlah_matrik_baris);
            $lambda_maks = array_sum($jumlah_matrik_baris);
            $ci = ($lambda_maks - $n) / ($n - 1);
            $ir = array(0, 0, 0.58, 0.9, 1.12, 1.24, 1.32, 1.41, 1.45, 1.49, 1.51, 1.48, 1.56, 1.57, 1.59);
            if ($n <= 15) {
                $ir = $ir[$n - 1];
            } else {
                $ir = $ir[14];
            }
            $cr = number_format($ci / $ir, 5);


            $i = 0;
            foreach ($data['sub'] as $row) {
                $sub = Sub::find($row->id);
                $sub->bobot = $prioritas[$i++];
                $sub->save();
            }

            $data['list_data'] = $this->tampil_data_1($matrik_kriteria, $jumlah_kolom, $id);
            $data['list_data2'] = $this->tampil_data_2($matrik_normalisasi, $prioritas, $jumlah_kolom, $id);
            $data['list_data3'] = $this->tampil_data_3($matrik_baris, $jumlah_matrik_baris, $id);
            $list_data = $this->tampil_data_4($jumlah_matrik_baris, $prioritas, $hasil_tabel_konsistensi, $id);
            $data['list_data4'] = $list_data[0];
            $data['list_data5'] = $list_data[1];

            if ($cr <= 0.1) {
                Session::flash('success', 'Nilai perbandingan: KONSISTEN!');
            } else {
                Session::flash('error', 'Nilai perbandingan: TIDAK KONSISTEN!');
            }
        }

        $result = array();
        $i = 0;
        foreach ($data['sub'] as $row1) {
            $ii = 0;
            foreach ($data['sub'] as $row2) {
                if ($i < $ii) {
                    $sub_ahp =
                        DB::table('sub_ahps')
                        ->where('id_sub1', '=', $row1->id)
                        ->where('id_sub2', '=', $row2->id)
                        ->first();
                    if (empty($sub_ahp)) {
                        $ahp = new SubAhp();
                        $ahp->id_sub1 = $row1->id;
                        $ahp->id_sub2 = $row2->id;
                        $ahp->nilai1 = 1;
                        $ahp->nilai2 = 1;
                        $ahp->save();

                        $nilai_1 = 1;
                        $nilai_2 = 1;
                    } else {
                        $nilai_1 = $sub_ahp->nilai1;
                        $nilai_2 = $sub_ahp->nilai2;
                    }
                    $nilai = 0;
                    if ($nilai_1 < 1) {
                        $nilai = $nilai_2;
                    } elseif ($nilai_1 > 1) {
                        $nilai = -$nilai_1;
                    } elseif ($nilai_1 == 1) {
                        $nilai = 1;
                    }
                    $result[$row1->id][$row2->id] = $nilai;
                }
                $ii++;
            }
            $i++;
        }

        $data['sub_ahp'] = $result;
        return view('backend.sub.preferensi', ['id' => $id], $data);
    }

    // --- metode AHP --- START
    public function ahp_get_matrik_kriteria($sub)
    {
        $matrik = array();
        $i = 0;
        foreach ($sub as $row1) {
            $ii = 0;
            foreach ($sub as $row2) {
                if ($i == $ii) {
                    $matrik[$i][$ii] = 1;
                } else {
                    if ($i < $ii) {
                        $sub_ahp = DB::table('sub_ahps')
                            ->where('id_sub1', '=', $row1)
                            ->where('id_sub2', '=', $row2)
                            ->first();
                        if (empty($sub_ahp)) {
                            $matrik[$i][$ii] = 1;
                            $matrik[$ii][$i] = 1;
                        } else {
                            $matrik[$i][$ii] = $sub_ahp->nilai1;
                            $matrik[$ii][$i] = $sub_ahp->nilai2;
                        }
                    }
                }
                $ii++;
            }
            $i++;
        }
        return $matrik;
    }

    public function ahp_get_jumlah_kolom($matrik)
    {
        $jumlah_kolom = array();
        for ($i = 0; $i < count($matrik); $i++) {
            $jumlah_kolom[$i] = 0;
            for ($ii = 0; $ii < count($matrik); $ii++) {
                $jumlah_kolom[$i] = $jumlah_kolom[$i] + $matrik[$ii][$i];
            }
        }
        return $jumlah_kolom;
    }

    public function ahp_get_normalisasi($matrik, $jumlah_kolom)
    {
        $matrik_normalisasi = array();
        for ($i = 0; $i < count($matrik); $i++) {
            for ($ii = 0; $ii < count($matrik); $ii++) {
                $matrik_normalisasi[$i][$ii] = number_format($matrik[$i][$ii] / $jumlah_kolom[$ii], 3);
                // $matrik_normalisasi[$i][$ii] = $matrik[$i][$ii] / $jumlah_kolom[$ii];
            }
        }
        return $matrik_normalisasi;
    }

    public function ahp_get_prioritas($matrik_normalisasi)
    {
        $prioritas = array();
        for ($i = 0; $i < count($matrik_normalisasi); $i++) {
            $prioritas[$i] = 0;
            for ($ii = 0; $ii < count($matrik_normalisasi); $ii++) {
                $prioritas[$i] = $prioritas[$i] + $matrik_normalisasi[$i][$ii];
            }
            $prioritas[$i] = number_format($prioritas[$i] / count($matrik_normalisasi), 3);
            // $prioritas[$i] = $prioritas[$i] / count($matrik_normalisasi);
        }
        return $prioritas;
    }

    public function ahp_get_matrik_baris($prioritas, $matrik_kriteria)
    {
        $matrik_baris = array();
        for ($i = 0; $i < count($matrik_kriteria); $i++) {
            for ($ii = 0; $ii < count($matrik_kriteria); $ii++) {
                $matrik_baris[$i][$ii] = $prioritas[$ii] * $matrik_kriteria[$i][$ii];
            }
        }
        return $matrik_baris;
    }

    public function ahp_get_jumlah_matrik_baris($matrik_baris)
    {
        $jumlah_baris = array();
        for ($i = 0; $i < count($matrik_baris); $i++) {
            $jumlah_baris[$i] = 0;
            for ($ii = 0; $ii < count($matrik_baris); $ii++) {
                $jumlah_baris[$i] = $jumlah_baris[$i] + $matrik_baris[$i][$ii];
            }
        }
        return $jumlah_baris;
    }

    public function ahp_get_tabel_konsistensi($jumlah_matrik_baris, $prioritas)
    {
        $jumlah = array();
        for ($i = 0; $i < count($jumlah_matrik_baris); $i++) {
            $jumlah[$i] = $jumlah_matrik_baris[$i] + $prioritas[$i];
        }
        return $jumlah;
    }

    public function ahp_uji_konsistensi($tabel_konsistensi)
    {
        $jumlah = array_sum($tabel_konsistensi);
        $n = count($tabel_konsistensi);
        $lambda_maks = $jumlah / $n;
        $ci = ($lambda_maks - $n) / ($n - 1);
        $ir = array(0, 0, 0.58, 0.9, 1.12, 1.24, 1.32, 1.41, 1.45, 1.49, 1.51, 1.48, 1.56, 1.57, 1.59);
        if ($n <= 15) {
            $ir = $ir[$n - 1];
        } else {
            $ir = $ir[14];
        }
        $cr = number_format($ci / $ir, 5);

        if ($cr <= 0.1) {
            // return true;
            Session::flash('success', 'Nilai perbandingan: KONSISTEN!');
        } else {
            Session::flash('error', 'Nilai perbandingan: TIDAK KONSISTEN!');
            // return false;
        }

        // return $cr;
    }
    // --- metode AHP --- END

    // --- untuk menampilkan langkah perhitungan ---
    public function tampil_data_1($matrik_kriteria, $jumlah_kolom, $id)
    {
        $sub = Sub::where('id_kriteria', $id)->get();
        // --- tabel matriks perbandingan berpasangan
        $list_data = '';
        $list_data .= '<tr><td></td>';
        foreach ($sub as $row) {
            $list_data .= '<td class="text-center">' . $row->nama_sub . '</td>';
        }
        $list_data .= '</tr>';
        $i = 0;
        foreach ($sub as $row) {
            $list_data .= '<tr>';
            $list_data .= '<td>' . $row->nama_sub . '</td>';
            $ii = 0;
            foreach ($sub as $row2) {
                $list_data .= '<td class="text-center">' . $matrik_kriteria[$i][$ii] . '</td>';
                $ii++;
            }
            $list_data .= '</tr>';
            $i++;
        }
        $list_data .= '<tr><td class="font-weight-bold">Jumlah</td>';
        for ($i = 0; $i < count($jumlah_kolom); $i++) {
            $list_data .= '<td class="text-center font-weight-bold">' . $jumlah_kolom[$i] . '</td>';
        }
        $list_data .= '</tr>';
        // ---
        return $list_data;
    }

    public function tampil_data_2($matrik_normalisasi, $prioritas, $jumlah_kolom, $id)
    {
        $sub = Sub::where('id_kriteria', $id)->get();
        // --- matriks nilai kriteria
        $list_data2 = '';
        $list_data2 .= '<tr><td></td>';
        foreach ($sub as $row) {
            $list_data2 .= '<td class="text-center">' . $row->nama_sub . '</td>';
        }
        $list_data2 .= '<td class="text-center font-weight-bold">Jumlah</td>';
        $list_data2 .= '<td class="text-center font-weight-bold">Prioritas</td>';
        $list_data2 .= '<td class="text-center font-weight-bold">Eigen Value</td>';
        $list_data2 .= '</tr>';
        $i = 0;
        foreach ($sub as $row) {
            $list_data2 .= '<tr>';
            $list_data2 .= '<td>' . $row->nama_sub . '</td>';
            $jumlah = 0;
            $ii = 0;
            foreach ($sub as $row2) {
                $list_data2 .= '<td class="text-center">' . $matrik_normalisasi[$i][$ii] . '</td>';
                $jumlah += $matrik_normalisasi[$i][$ii];
                $ii++;
            }
            $eigenvalue = $prioritas[$i] * $jumlah_kolom[$i];
            $list_data2 .= '<td class="text-center font-weight-bold">' . $jumlah . '</td>';
            $list_data2 .= '<td class="text-center font-weight-bold">' . number_format($prioritas[$i], 3) . '</td>';
            $list_data2 .= '<td class="text-center font-weight-bold">' . number_format($eigenvalue, 3) . '</td>';
            $list_data2 .= '</tr>';
            $i++;
        }
        // ---
        return $list_data2;
    }

    public function tampil_data_3($matrik_baris, $jumlah_matrik_baris, $id)
    {
        $sub = Sub::where('id_kriteria', $id)->get();
        // --- matriks penjumlahan setiap baris
        $list_data3 = '';
        $list_data3 .= '<tr><td></td>';
        foreach ($sub as $row) {
            $list_data3 .= '<td class="text-center">' . $row->nama_sub . '</td>';
        }
        $list_data3 .= '<td class="text-center font-weight-bold">Jumlah</td>';
        $list_data3 .= '</tr>';
        $i = 0;
        foreach ($sub as $row) {
            $list_data3 .= '<tr>';
            $list_data3 .= '<td>' . $row->nama_sub . '</td>';
            $ii = 0;
            foreach ($sub as $row2) {
                $list_data3 .= '<td class="text-center">' . $matrik_baris[$i][$ii] . '</td>';
                $ii++;
            }
            $list_data3 .= '<td class="text-center font-weight-bold">' . $jumlah_matrik_baris[$i] . '</td>';
            $list_data3 .= '</tr>';
            $i++;
        }
        // ---
        return $list_data3;
    }

    public function tampil_data_4($jumlah_matrik_baris, $prioritas, $hasil_tabel_konsistensi, $id)
    {
        $sub = Sub::where('id_kriteria', $id)->get();
        // --- perhitungan rasio konsistensi
        $list_data4 = '';
        $list_data4 .= '<tr><td></td>';
        $list_data4 .= '<td class="text-center">Jumlah per Baris</td>';
        $list_data4 .= '<td class="text-center">Prioritas</td>';
        $list_data4 .= '</tr>';
        $i = 0;
        foreach ($sub as $row) {
            $list_data4 .= '<tr>';
            $list_data4 .= '<td>' . $row->id_sub . '</td>';
            $list_data4 .= '<td class="text-center">' . $jumlah_matrik_baris[$i] . '</td>';
            $list_data4 .= '<td class="text-center">' . $prioritas[$i] . '</td>';
            $list_data4 .= '</tr>';
            $i++;
        }

        $n = count($jumlah_matrik_baris);
        $lambda_maks = array_sum($jumlah_matrik_baris);
        $ci = ($lambda_maks - $n) / ($n - 1);
        $ir = array(0, 0, 0.58, 0.9, 1.12, 1.24, 1.32, 1.41, 1.45, 1.49, 1.51, 1.48, 1.56, 1.57, 1.59);
        if ($n <= 15) {
            $ir = $ir[$n - 1];
        } else {
            $ir = $ir[14];
        }
        $cr = number_format($ci / $ir, 5);

        $list_data5 = '';
        $list_data5 .= '<table class="table">
			<tr>
				<td width="100">n </td>
				<td>= ' . $n . '</td>
			</tr>
			<tr>
				<td width="100">λ maks</td>
				<td>= ' . number_format($lambda_maks, 5) . '</td>
			</tr>
			<tr>
				<td width="100">CI</td>
				<td>= ' . number_format($ci, 5) . '</td>
			</tr>
			<tr>
				<td width="100">CR</td>
				<td>= ' . $cr . '</td>
			</tr>
			<tr>
				<td width="100">CR <= 0.1</td>';
        if ($cr <= 0.1) {
            $list_data5 .= '
				<td>Konsisten</td>';
        } else {
            $list_data5 .= '
				<td>Tidak Konsisten</td>';
        }
        $list_data5 .= '
			</tr>
			</table>';
        // ---
        return array($list_data4, $list_data5);
    }
}
