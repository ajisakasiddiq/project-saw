<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

use App\Mail\RegisterMail;
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi
        $request->validate([
            'input' => 'required',
            'password' => 'required'
        ], [
            'input.required' => 'Isian wajib diisi NIM atau Email',
            'password.required' => 'Sandi wajib diisi',
        ]);

        // cek tipe inputan, apakah menggunakan email atau username
        $login_type = filter_var($request->input('input'), FILTER_VALIDATE_EMAIL)
            ? 'email' : 'nama';

        // hasil opsi validasi di atas, digabungkan
        $request->merge([
            $login_type => $request->input('input')
        ]);

        $user = User::where(filter_var($request->input('input'), FILTER_VALIDATE_EMAIL)
            ? 'email' : 'nama', '=', $request->input('input'))->first();

        if (Auth::attempt($request->only($login_type, 'password'))) {
            return redirect()->route('beranda')->with(['success' => 'Login Berhasil!']);
        } else {
            return redirect()->route('auth')->with(['error' => 'Login Gagal, user dan password tidak terdaftar atau cek inputan!']);
        }
    }

    public function create()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // $check = DB::users
        $request->validate([
            'nim' => 'required|max:9',
            'email' => 'required|unique:users',
            'password' => 'required|required_with:cpassword|same:cpassword|min:6',
            'cpassword' => 'required|min:6'
        ], [
            'nim.required' => 'NIM wajib diisi',
            'nim.max' => 'NIM berjumlah 9 karakter',
            // 'nim.unique' => 'NIM sudah terdaftar sebagai akun',
            'email.required' => 'Email wajib diisi',
            'email.unique' => 'Email sudah terdaftar',
            'password.required_with' => 'Sandi harus diisi dua-duanya',
            'password.same' => 'Sandi harus sama',
            'password.required' => 'Sandi wajib diisi',
            // 'password.confirmed' => 'Sandi wajib sama',
            'password.min' => 'Sandi minimal 6 karakter',
            'cpassword.required' => 'Ulang Sandi wajib diisi',
            'cpassword.min' => 'Sandi minimal 6 karakter',
        ]);

        $check =
            DB::table('mahasiswa')
            ->where('nim', '=', $request->nim)
            ->first();

        if ($check) {
            $save = new User;
            $save->nama = strtoupper(trim($request->nim));
            $save->email = trim($request->email);
            $save->role = "Mahasiswa";
            $save->foto = "default.jpg";
            $save->hash = Str::random(40);
            $save->password = Hash::make($request->password);
            $save->save();

            Mail::to($save->email)->send(new RegisterMail($save));
            return redirect()->route('auth')->with('success', 'Registrasi akun berhasil, cek email untuk verifikasi akun!');
        } else {
            return redirect()->route('registrasi')->with('error', 'Registrasi akun gagal, karena nim yang dimasukkan tidak terdaftar!');
        }
    }

    public function verify($token)
    {
        // Verifikasi Akun

        $user = User::where('hash', '=', $token)->first();

        if (!empty($user)) {
            $user->email_verified_at = date('Y-m-d H:i:s');
            $user->hash = Str::random(40);
            $user->save();

            return redirect()->route('auth')->with('success', 'Verifikasi akun berhasil');
        } else {
            abort(404);
        }
    }

    public function forgot()
    {
        return view('auth.forgot');
    }

    public function forgot_password(Request $request)
    {
        $user = User::where('email', '=', $request->email)->first();

        if (!empty($user)) {
            $user->hash = Str::random(40);
            $user->save();

            Mail::to($user->email)->send(new ForgotPasswordMail($user));
            return redirect()->back()->with('success', 'Link reset sandi sudah dikirimkan ke email');
        } else {
            return redirect()->back()->with('error', 'Email tidak terdaftar');
        }
    }

    public function reset($token)
    {

        $user = User::where('hash', '=', $token)->first();

        if (!empty($user)) {
            $data['user'] = $user;
            return view('auth.reset', $data);
        } else {
            abort(404);
        }
    }

    public function reset_pass($token, Request $request)
    {
        // Reset Sandi
        $request->validate([
            'password' => 'required|required_with:cpassword|same:cpassword|min:6',
            'cpassword' => 'required|min:6'
        ], [
            'password.required_with' => 'Sandi harus diisi dua-duanya',
            'password.same' => 'Sandi harus sama',
            'password.required' => 'Sandi wajib diisi',
            'password.min' => 'Sandi minimal 6 karakter',
            'cpassword.required' => 'Ulang Sandi wajib diisi',
            'cpassword.min' => 'Sandi minimal 6 karakter',
        ]);

        $user = User::where('hash', '=', $token)->first();

        if (!empty($user)) {
            $user->password = Hash::make($request->password);
            $user->hash = Str::random(40);
            $user->save();

            return redirect()->route('auth')->with('success', 'Reset sandi berhasil');
        } else {
            abort(404);
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('auth')->with('success', 'Anda berhasil keluar (Logout)');
    }
}
