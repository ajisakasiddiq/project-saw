<?php

namespace App\Http\Controllers;

use App\Imports\MhsImport;
use Illuminate\Http\Request;
use App\Models\College;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Excel;

class CollegeController extends Controller
{
    public function index()
    {
        // $data['mhs'] = DB::table('mahasiswa')->get();
        $data['mhs'] = DB::table('mahasiswa')
            ->join('jurusan', 'mahasiswa.id_jurusan', '=', 'jurusan.id')
            ->join('prodi', 'mahasiswa.id_prodi', '=', 'prodi.id')
            ->select('jurusan.nama_jurusan', 'prodi.nama_prodi', 'mahasiswa.*')
            ->get();
        return view('backend.mahasiswa.index', $data);
    }

    function tambah()
    {
        $data['jur'] = DB::table('jurusan')->get();
        return view('backend.mahasiswa.tambah', $data);
    }

    public function getprodi(Request $request)
    {
        $id_jurusan = $request->id_jurusan;

        $prodi = DB::table('prodi')
            ->where('id_jurusan', '=', $id_jurusan)
            ->get();

        $option = '<option value="">-- Pilih Program Studi --</option>';
        foreach ($prodi as $p) {
            $option .= "<option value='$p->id'>$p->nama_prodi</option>";
        }

        echo $option;
    }

    public function getprodi2(Request $request)
    {
        $id_jurusan = $request->id_jurusan;
        $id_prodi = $request->id_prodi;

        $prodi = DB::table('prodi')
            ->where('id_jurusan', '=', $id_jurusan)
            ->get();

        if ($id_prodi != "") {
            $option = '<option value="">-- Pilih Program Studi --</option>';
            foreach ($prodi as $p) {
                $if = $p->id == $id_prodi ? 'selected' : '';
                $option .= "<option value='$p->id' '$if'>$p->nama_prodi</option>";
            }
        }

        echo $option;
    }

    public function import(Request $request)
    {
        // dd($request->all());

        Excel::import(new MhsImport(), $request->file('file'));

        return redirect()->route('mahasiswa')->with(['success' => 'Tambah Mahasiswa Berhasil!']);
    }

    public function create(Request $request)
    {
        $request->validate([
            'nim' => 'required|max:12|min:12|unique:mahasiswa',
            'nama' => 'required',
            'jurusan' => 'required',
            'prodi' => 'required',
            'jalur_masuk' => 'required',
            'ponsel' => 'required|max:13',
            'alamat' => 'required',
        ], [
            'nim.required' => 'NIM wajib diisi',
            'nim.min' => 'NIM tidak boleh kurang dari 9 karakter',
            'nim.max' => 'NIM maksimal berjumlah 9 karakter',
            'nim.unique' => 'NIM sudah terdaftar',
            'nama.required' => 'Nama Mahasiswa wajib diisi',
            'jurusan.required' => 'Jurusan wajib diisi',
            'prodi.required' => 'Program Studi wajib diisi',
            'jalur_masuk.required' => 'Jalur Masuk wajib diisi',
            'ponsel.required' => 'Nomor Ponsel wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
        ]);

        $save = new College();
        $save->nim = trim($request->nim);
        $save->nama = trim($request->nama);
        $save->id_jurusan = trim($request->jurusan);
        $save->id_prodi = trim($request->prodi);
        $save->jalur_masuk = trim($request->jalur_masuk);
        $save->ponsel = trim($request->ponsel);
        $save->alamat = trim($request->alamat);
        $save->save();

        return redirect()->route('mahasiswa')->with(['success' => 'Tambah Mahasiswa Berhasil!']);
    }

    public function edit($id)
    {
        $data['mhs'] = College::where('id', $id)->get();
        $data['jur'] = DB::table('jurusan')->get();
        $mhs = DB::table('mahasiswa')
            ->select('mahasiswa.id_prodi')
            ->where('id', '=', $id)->first();
        $prodi = DB::table('prodi')->where("id", "=", $mhs->id_prodi)->first();
        $data['prodi'] = $prodi->nama_prodi;
        $data['id_prodi'] = $mhs->id_prodi;
        return view('backend.mahasiswa.edit', $data);
    }

    function update(Request $request)
    {

        $request->validate([
            'nim' => 'required|max:9|min:9',
            'nama' => 'required',
            'jurusan' => 'required',
            // 'prodi' => 'required',
            'jalur_masuk' => 'required',
            'ponsel' => 'required|max:13',
            'alamat' => 'required',
        ], [
            'nim.required' => 'NIM wajib diisi',
            'nim.min' => 'NIM tidak boleh kurang dari 9 karakter',
            'nim.max' => 'NIM maksimal berjumlah 9 karakter',
            'nama.required' => 'Nama Mahasiswa wajib diisi',
            'jurusan.required' => 'Jurusan wajib diisi',
            // 'prodi.required' => 'Program Studi wajib diisi',
            'jalur_masuk.required' => 'Jalur Masuk wajib diisi',
            'ponsel.required' => 'Nomor Ponsel wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
        ]);

        $save = College::find($request->id);

        $save->nim = trim($request->nim);
        $save->nama = trim($request->nama);
        $save->id_jurusan = trim($request->jurusan);
        if ($request->prodi == "" || $request->prodi == null) {
            $save->id_prodi = $save->id_prodi;
        } else {
            $save->id_prodi = trim($request->prodi);
        }
        $save->jalur_masuk = trim($request->jalur_masuk);
        $save->ponsel = trim($request->ponsel);
        $save->alamat = trim($request->alamat);
        $save->save();

        return redirect()->route('mahasiswa')->with(['success' => 'Edit Mahasiswa Berhasil!']);
    }

    function hapus($id)
    {
        DB::table('mahasiswa')->where('id', $id)->delete();

        return redirect()->route('mahasiswa')->with(['success' => 'Hapus Berhasil!']);
    }
}
