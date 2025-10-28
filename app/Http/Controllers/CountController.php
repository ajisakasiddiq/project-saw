<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Criteria;
use App\Models\Result;
use App\Models\Value;
use App\Models\College;
use Illuminate\Http\Request;
use App\Models\Form;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Response;

class CountController extends Controller
{
    public function index()
    {
        // $data['mhs'] = DB::table('mahasiswa')->get();
        $count = DB::table('form')
            // ->join('alternatif', 'alternatif.id_form', '=', 'form.id')
            ->orderBy('form.id', 'DESC')
            ->where('form.status', '!=', 0)
            ->get();

        $data = [
            'count' => $count,
        ];

        return view('backend.hitung.index', $data);
    }

    function kuota(Request $request)
    {
        $request->validate([
            'kuota' => 'required',
        ], [
            'kuota.required' => 'Kuota wajib diisi'
        ]);

        $form = Form::find($request->id_kuota);

        $form->kuota = $request->kuota;
        $form->save();

        $values = DB::table('results')
            ->where('id_form', '=', $request->id_kuota)
            ->where('total_nilai', '!=', '')
            ->get();

        for ($i = 0; $i < count($values); $i++) {
            if ($i < $request->kuota) {
                $status = '1';
            } else {
                $status = '2';
            }

            $alt = Result::find($values[$i]->id);
            $alt->status = $status;
            $alt->save();
        }

        return redirect()->route('hasil')->with(['success' => 'Setting Jumlah Kuota Penerima Berhasil!']);
    }

    public function hasil()
    {
        $hasil = DB::table('form')
            ->where('form.status', '=', '2')
            ->orderByDesc('form.id')
            ->get();

        $data = [
            'hasil' => $hasil,
        ];

        return view('backend.hitung.hasil', $data);
    }

    public function final($id)
    {
        $alternatif = DB::table('alternatif')
            ->join('mahasiswa', 'alternatif.id_mahasiswa', '=', 'mahasiswa.id')
            ->join('jurusan', 'mahasiswa.id_jurusan', '=', 'jurusan.id')
            ->join('prodi', 'mahasiswa.id_prodi', '=', 'prodi.id')
            ->join('form', 'alternatif.id_form', '=', 'form.id')
            ->select('alternatif.*', 'mahasiswa.*', 'jurusan.*', 'prodi.*')
            ->where('form.id', '=', $id)
            ->where('alternatif.status', '!=', '0')
            ->orderByRaw('alternatif.status')
            // ->where('alternatif.sub_bobot', '!=', '')
            ->get();
        $results = Result::with('mahasiswa')
            ->with('mahasiswa.jurusan')
            ->with('mahasiswa.prodi')
            ->with('form')
            ->orderByDesc('total_nilai')->get();

        $form = DB::table('form')
            ->where('id', '=', $id)->first();

        $data = [
            'results' => $results,
            'alternatif' => $alternatif,
            'id_form' => $form->id,
            'nama_form' => $form->nama_form,
            'kuota_form' => $form->kuota,
            'dibuat' => $form->created_at,
        ];

        return view('backend.hitung.final', $data);
    }

    // public function download($dokumen)
    // {
    //     $get_data = DB::table('alternatif')->where('dokumen', '=', "$dokumen")->first();
    //     $dok = $get_data->dokumen;
    //     // $path = public_path('/document/accounts/', $get_data->dokumen);
    //     // $header = ['Content-Type: application/pdf'];

    //     $file = public_path() . "/document/accounts/$dok";

    //     $headers = array(
    //         'Content-Type: application/pdf',
    //     );

    //     // return Response::download($file, "$get_data->dokumen", $headers);

    //     return Response::download($path);
    // }

    public function detail($id)
    {
        $alternatif = DB::table('alternatif')
            ->join('mahasiswa', 'alternatif.id_mahasiswa', '=', 'mahasiswa.id')
            ->join('jurusan', 'mahasiswa.id_jurusan', '=', 'jurusan.id')
            ->join('prodi', 'mahasiswa.id_prodi', '=', 'prodi.id')
            ->join('form', 'alternatif.id_form', '=', 'form.id')
            ->orderBy('alternatif.id', 'DESC')
            ->where('alternatif.id_form', '=', $id)
            ->where('alternatif.sub_bobot', '!=', '')
            ->get();

        $form = DB::table('form')
            ->where('id', '=', $id)->first();

        $data = [
            'alternatif' => $alternatif,
            'id_form' => $form->id,
            'nama_form' => $form->nama_form,
            'dibuat' => $form->created_at,
        ];
        // $data['nama_form'] = $data['alternatif']->nama_form;
        return view('backend.hitung.detail', $data);
    }

    public function sort($id)
    {
        $results = Result::with('mahasiswa')
            ->with('mahasiswa.jurusan')
            ->with('mahasiswa.prodi')
            ->with('form')
            ->orderByDesc('total_nilai')->get();
        $alternatif = DB::table('alternatif')
            ->join('mahasiswa', 'alternatif.id_mahasiswa', '=', 'mahasiswa.id')
            ->join('jurusan', 'mahasiswa.id_jurusan', '=', 'jurusan.id')
            ->join('prodi', 'mahasiswa.id_prodi', '=', 'prodi.id')
            ->join('form', 'alternatif.id_form', '=', 'form.id')
            ->where('form.id', '=', $id)
            ->where('alternatif.status', '!=', '0')
            ->orderByDesc('alternatif.nilai')
            // ->where('alternatif.sub_bobot', '!=', '')
            ->get();

        $form = DB::table('form')
            ->where('id', '=', $id)->first();

        $kriteria = DB::table('kriteria')->orderByDesc('bobot')->get();

        foreach ($kriteria as $k) {
            $subQuery[] = DB::table('sub')->where('id_kriteria', '=', $k->id)->orderBy('sub.bobot', 'ASC')->get();
        }

        $data = [
            'results' => $results,
            'alternatif' => $alternatif,
            'kriteria' => $kriteria,
            'sub' => $subQuery,
            'id_form' => $form->id,
            'nama_form' => $form->nama_form,
            'kuota_form' => $form->kuota,
            'dibuat' => $form->created_at,
        ];
        // $data['nama_form'] = $data['alternatif']->nama_form;
        return view('backend.hitung.sort', $data);
    }

    public function list()
    {
        $rank = DB::table('form')
            // ->join('alternatif', 'form.id', '=', 'alternatif.id_form')
            ->where('form.status', '=', '2')
            // ->where('alternatif.nilai', '!=', 0)
            ->orderByDesc('form.id')
            ->get();

        $data = [
            'rank' => $rank,
        ];

        return view('backend.hitung.list', $data);
    }

    function rank($id)
    {
        $form = DB::table('form')
            ->where('id', '=', $id)->first();

        $id_form = $form->id;

        $values = Value::where('id_form', $id_form)->get();
        $criterias = Criteria::all();
        $students = College::whereIn('id', $values->pluck('id_mahasiswa'))->get();


        // Ambil nilai dari tabel 'values'
        $matrix = [];
        foreach ($criterias as $criteria) {
            foreach ($students as $student) {
                $nilai = Value::where('id_mahasiswa', $student->id)
                    ->where('id_kriteria', $criteria->id)
                    ->where('id_form', $id_form)
                    ->value('nilai') ?? 0; // default 0 jika kosong
                $matrix[$criteria->id][$student->id] = $nilai;
            }
        }
        // Normalisasi matriks
        $normalisasi = [];
        foreach ($criterias as $criteria) {
            $values = $matrix[$criteria->id];
            $max = max($values);
            $min = min($values);

            foreach ($students as $student) {
                $nilai = $matrix[$criteria->id][$student->id];
                if ($criteria->jenis === 'benefit') {
                    $normalisasi[$student->id][$criteria->id] = ($max != 0) ? $nilai / $max : 0;
                } else {
                    $normalisasi[$student->id][$criteria->id] = ($nilai != 0) ? $min / $nilai : 0;
                }
            }
        }

        // Hitung total SAW + tentukan golongan otomatis
        foreach ($students as $student) {
            $total = 0;
            foreach ($criterias as $criteria) {
                $total += $criteria->bobot * $normalisasi[$student->id][$criteria->id];
            }

            // Tentukan golongan otomatis
            $golongan = $this->tentukanGolongan($total);

            // Simpan ke tabel results
            Result::updateOrCreate(
                [
                    'id_mahasiswa' => $student->id,
                    'id_form' => $id_form,
                ],
                [
                    'total_nilai' => $total,
                    'golongan' => $golongan
                ]
            );
        }

        return redirect()->route('list')->with(['success' => 'Perhitungan Berhasil!']);
    }
    private function tentukanGolongan($skor)
    {
        if ($skor > 0.875) return 'GOL 1';
        if ($skor > 0.75)  return 'GOL 2';
        if ($skor > 0.625) return 'GOL 3';
        if ($skor > 0.5)   return 'GOL 4';
        if ($skor > 0.375) return 'GOL 5';
        if ($skor > 0.25)  return 'GOL 6';
        if ($skor > 0.125) return 'GOL 7';
        return 'GOL 8';
    }
}
