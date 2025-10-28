<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == "Mahasiswa") {
            $nim = Auth::user()->nama;
            $db = DB::table('mahasiswa')
                ->where('nim', '=', "$nim")
                ->first();
            $data['nama'] = $db->nama;
            return view('backend.profil', $data);
        }
        return view('backend.profil');
    }

    function update(Request $request)
    {

        $request->validate([
            'gambar' => 'image|file|max:1024',
            'nama' => 'required|min:4',
            'email' => 'required|email',
            // 'role' => 'required',
            // 'password' => 'min:6',
        ], [
            'gambar.image' => 'File wajib image',
            'gambar.file' => 'Wajib file',
            'gambar.max' => 'Bidang gambar tidak boleh lebih besar dari 1024 kilobyte',
            'nama.required' => 'Nama wajib diisi',
            'nama.min' => 'Nama minimal harus 4 karakter',
            'nama.unique' => 'Nama sudah terpakai, gunakan nama lain',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email invalid',
            'email.email' => 'Email sudah terpakai, gunakan email lain',
            // 'password.required' => 'Password wajib diisi',
            // 'password.min' => 'Password minimal harus 6 karakter',
        ]);

        $user = User::find(Auth::user()->id);

        if ($request->hasFile('gambar')) {
            $old_image = $user->foto;
            if ($old_image != 'default.jpg') {
                unlink(public_path('picture/accounts/' . $old_image));
            }
            $gambar_file = $request->file('gambar');
            $foto_ekstensi = $gambar_file->extension();
            $nama_foto = date('ymdhis') . "." . $foto_ekstensi;
            $gambar_file->move(public_path('picture/accounts'), $nama_foto);
            $user->foto = $nama_foto;
        }

        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->role = $user->role;
        if ($request->password != null || $request->password != "") {
            $request->validate([
                'password' => 'min:6'
            ], [
                'password.min' => 'Password minimal harus 6 karakter'
            ]);

            $user->password = Hash::make($request->password);
        } else {
            $user->password = $user->password;
        }
        $user->save();

        return redirect()->route('profil')->with(['success' => 'Edit Profil Berhasil!']);
    }
}
