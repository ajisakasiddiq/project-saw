<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

use App\Mail\RegisterMail;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index()
    {
        // $data['user'] = DB::table('users')->where('role', '!=', 'Admin')->get();
        $data['user'] = DB::table('users')->where('role', '!=', 'Admin')->orderBy('created_at', 'desc')->get();
        return view('backend.user.index', $data);
    }

    public function tambah()
    {
        return view('backend.user.tambah');
    }

    function create(Request $request)
    {
        $str = Str::random(40);
        $gambar = '';

        $request->validate([
            'nama' => 'required|min:4|unique:users',
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'password' => 'required|min:6',
        ], [
            'nama.required' => 'Nama wajib diisi',
            'nama.min' => 'Nama minimal harus 4 karakter',
            'nama.unique' => 'Nama sudah terpakai, gunakan nama lain',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email invalid',
            'email.email' => 'Email sudah terpakai, gunakan email lain',
            'role.required' => 'Role wajib diisi',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal harus 6 karakter',
        ]);

        if ($request->hasFile('gambar')) {

            $request->validate(['gambar' => 'mimes:jpeg,jpg,png,gif|image|file|max:1024']);

            $gambar_file = $request->file('gambar');
            $foto_ekstensi = $gambar_file->extension();
            $nama_foto = date('ymdhis') . "." . $foto_ekstensi;
            $gambar_file->move(public_path('picture/accounts'), $nama_foto);
            $gambar = $nama_foto;
        } else {
            $gambar = "default.jpg";
        }

        $save = new User;
        $save->nama = trim($request->nama);
        $save->email = trim($request->email);
        $save->role = $request->role;
        $save->foto = $gambar;
        $save->hash = $str;
        $save->password = Hash::make($request->password);
        $save->save();

        Mail::to($save->email)->send(new RegisterMail($save));

        return redirect()->route('user')->with(['success' => 'Tambah User Berhasil!']);
    }

    public function edit($id)
    {
        $data = User::where('id', $id)->get();
        return view('backend.user.edit', ['uc' => $data]);
    }

    function update(Request $request)
    {

        $request->validate([
            'gambar' => 'image|file|max:1024',
            'nama' => 'required|min:4',
            'email' => 'required|email',
            'role' => 'required',
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
            'role.required' => 'Role wajib diisi',
            // 'password.required' => 'Password wajib diisi',
            // 'password.min' => 'Password minimal harus 6 karakter',
        ]);

        $user = User::find($request->id);

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
        $user->role = $request->role;
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

        return redirect()->route('user')->with(['success' => 'Edit User Berhasil!']);
    }

    function hapus($id)
    {

        $user = User::find($id);
        $old_image = $user->foto;
        if ($old_image != 'default.jpg') {
            unlink(public_path('picture/accounts/' . $old_image));
        }

        DB::table('users')->where('id', $id)->delete();

        return redirect()->route('user')->with(['success' => 'Hapus Berhasil!']);
    }
}
