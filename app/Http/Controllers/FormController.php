<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Form;

class FormController extends Controller
{
    public function index()
    {
        $data['form'] = DB::table('form')->orderBy('created_at', 'desc')->get();
        return view('backend.form.index', $data);
    }

    public function tambah()
    {
        return view('backend.form.tambah');
    }

    function create(Request $request)
    {
        $request->validate([
            'nama_form' => 'required',
            'jenis' => 'required',
            'status' => 'required',
        ], [
            'nama_form.required' => 'Nama Formulir wajib diisi',
            'jenis.required' => 'Jenis wajib diisi',
            'status.required' => 'Status wajib diisi',
        ]);

        $check = DB::table('form')
            ->where('jenis', '=', "$request->jenis")
            // ->where('status', '=', '2')
            ->orderBy('id', 'DESC')
            ->first();

        // print_r("<pre>");
        // print_r($check);
        // print_r("</pre>");
        // die;

        // if ($check == null || $check == "" || empty($check)) {
        //     $save = new Form();
        //     $save->nama_form = trim($request->nama_form);
        //     $save->jenis = trim($request->jenis);
        //     $save->status = trim($request->status);
        //     $save->save();

        //     return redirect()->route('formulir')->with(['success' => 'Tambah Formulir Berhasil!']);
        // } else if ($check->status == "0" || $check->status == "1") {
        //     return redirect()->route('formulir')->with(['error' => 'Formulir ' . $request->jenis . ' Masih Ada, Hapus atau Tutup untuk Menambahkan Formulir Baru']);
        // // } else {
        $save = new Form();
        $save->nama_form = trim($request->nama_form);
        $save->jenis = trim($request->jenis);
        $save->status = trim($request->status);
        $save->save();

        return redirect()->route('formulir')->with(['success' => 'Tambah Formulir Berhasil!']);
        // }
    }

    public function edit($id)
    {
        $data['form'] = Form::where('id', $id)->get();
        return view('backend.form.edit', $data);
    }

    function update(Request $request)
    {

        $request->validate([
            'nama_form' => 'required',
            'jenis' => 'required',
            'status' => 'required',
        ], [
            'nama_form.required' => 'Nama Formulir wajib diisi',
            'jenis.required' => 'Jenis wajib diisi',
            'status.required' => 'Status wajib diisi',
        ]);

        $save = Form::find($request->id);

        $save->nama_form = trim($request->nama_form);
        $save->jenis = trim($request->jenis);
        $save->status = trim($request->status);
        $save->save();

        return redirect()->route('formulir')->with(['success' => 'Edit Formulir Berhasil!']);
    }

    function hapus($id)
    {
        DB::table('form')->where('id', $id)->delete();

        return redirect()->route('formulir')->with(['success' => 'Hapus Berhasil!']);
    }
}
