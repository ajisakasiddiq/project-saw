<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Value;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index()
    {
        $mhs = Auth::user()->nama;

        $alternatif = DB::table('mahasiswa')
            ->where('nim', '=', $mhs)
            ->first();

        $cek_mhs = $alternatif->id;

        $cek_alt = DB::table('alternatif')
            ->where('id_mahasiswa', '=', $cek_mhs)
            ->first();

        $form = DB::table('form')->orderBy('created_at', 'desc')->get();

        $data = [
            'form' => $form,
            'cek' => $cek_alt
        ];

        return view('backend.pendaftaran.data', $data);
    }

    public function hasil()
    {
        $mhs = Auth::user()->nama;

        $alternatif = DB::table('mahasiswa')
            ->where('nim', '=', $mhs)
            ->first();

        $cek_mhs = $alternatif->id;

        $cek_alt = DB::table('alternatif')
            ->join('mahasiswa', 'alternatif.id_mahasiswa', '=', 'mahasiswa.id')
            ->join('form', 'alternatif.id_form', '=', 'form.id')
            ->select('alternatif.*', 'mahasiswa.id', 'mahasiswa.nama', 'mahasiswa.nim', 'form.id', 'form.nama_form', 'form.jenis')
            ->where('id_mahasiswa', '=', $cek_mhs)
            ->get();

        $data = [
            'alt' => $cek_alt
        ];

        return view('backend.pendaftaran.hasil', $data);
    }

    public function detail($id)
    {
        $mhs = Auth::user()->nama;

        $alternatif = DB::table('mahasiswa')
            ->where('nim', '=', $mhs)
            ->first();

        $id_mhs = $alternatif->id;

        $kriteria = DB::table('kriteria')->orderByDesc('bobot')->get();

        foreach ($kriteria as $k) {
            $subQuery[] = DB::table('sub')->where('id_kriteria', '=', $k->id)->orderBy('sub.bobot', 'ASC')->get();
        }

        $check = DB::table('alternatif')
            ->where('id_mahasiswa', '=', $id_mhs)
            ->first();

        $status = $check->status ?? '';

        // print_r("<pre>");
        // print_r($subQuery);
        // print_r("</pre>");
        // die;

        $form = DB::table('form')
            ->where('id', '=', $id)->first();

        $data = [
            'kriteria' => $kriteria,
            'sub' => $subQuery,
            'mhs' => $alternatif,
            'status' => $status,
            'form' => $form
        ];

        return view('backend.pendaftaran.daftar', $data);
    }

    function create(Request $request)
    {

        $get_mhs = DB::table('mahasiswa')->where('nim', '=', $request->nim)->first();
        $cek = DB::table('kriteria')->get();


        for ($i = 0; $i < count($cek); $i++) {
            $nilai = $request->nilai_kriteria[$i];
            $idKriteria = $request->id_kriteria[$i]; // ambil id_kriteria per baris

            if ($nilai !== null && $nilai !== '') {
                $savevalue = new Value();
                $savevalue->id_mahasiswa = $get_mhs->id;
                $savevalue->id_form = $request->id_form;
                $savevalue->id_kriteria = $idKriteria;
                $savevalue->nilai = $nilai;
                $savevalue->save();
            }
        }
        return redirect()->route('pendaftaran')->with(['success' => 'Pendaftaran Berhasil!']);
    }
}
