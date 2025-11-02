<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\SubController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CollegeController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\CountController;
use App\Http\Controllers\RegisterController;
use App\Models\College;
use App\Models\Criteria;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::middleware('guest')->group(function () {
    Route::get('/sesi', [AuthController::class, 'index'])->name('auth');
    Route::post('/sesi', [AuthController::class, 'login']);
    Route::get('/reg', [AuthController::class, 'create'])->name('registrasi');
    Route::get('/verif/{token}', [AuthController::class, 'verify']);
    Route::post('/reg', [AuthController::class, 'register']);
    Route::get('/lupa', [AuthController::class, 'forgot'])->name('lupa-sandi');
    Route::post('/lupa', [AuthController::class, 'forgot_password']);
    Route::get('/ubah/{token}', [AuthController::class, 'reset']);
    Route::post('/ubah/{token}', [AuthController::class, 'reset_pass'])->name('reset-sandi');
});

Route::group(
    ['middleware' => ['auth', 'checkrole:Admin']],
    function () {
        Route::get('/preferensikt', [CriteriaController::class, 'preferensi']);
        Route::post('/preferensikt', [CriteriaController::class, 'bobot']);
        Route::get('/tambahkt', [CriteriaController::class, 'tambah']);
        Route::post('/tambahkt', [CriteriaController::class, 'create']);
        Route::get('/editkt/{id}', [CriteriaController::class, 'edit']);
        Route::post('/editkt/{id}', [CriteriaController::class, 'update']);
        Route::get('/hapuskt/{id}', [CriteriaController::class, 'hapus']);
        Route::get('/tambahsb', [SubController::class, 'tambah']);
        Route::post('/tambahsb', [SubController::class, 'create']);
        Route::get('/editsb/{id}', [SubController::class, 'edit']);
        Route::post('/editsb/{id}', [SubController::class, 'update']);
        Route::get('/preferensisb/{id}', [SubController::class, 'preferensi']);
        Route::post('/preferensisb/{id}', [SubController::class, 'bobot']);
        Route::get('/hapussb/{id}', [SubController::class, 'hapus']);
        Route::get('/user', [UserController::class, 'index'])->name('user');
        Route::get('/tambahuc', [UserController::class, 'tambah']);
        Route::post('/tambahuc', [UserController::class, 'create']);
        Route::get('/edituc/{id}', [UserController::class, 'edit']);
        Route::post('/edituc/{id}', [UserController::class, 'update']);
        Route::get('/hapusuc/{id}', [UserController::class, 'hapus']);
        Route::get('/tambahmh', [CollegeController::class, 'tambah']);
        Route::post('/tambahmh', [CollegeController::class, 'create']);
        Route::post('/importmhs', [CollegeController::class, 'import']);
        Route::post('/getprodi', [CollegeController::class, 'getprodi'])->name('getprodi');
        Route::post('/getprod2', [CollegeController::class, 'getprodi2'])->name('getprodi2');
        Route::get('/editmh/{id}', [CollegeController::class, 'edit']);
        Route::post('/editmh/{id}', [CollegeController::class, 'update']);
        Route::get('/hapusmh/{id}', [CollegeController::class, 'hapus']);
        Route::get('/tambahfm', [FormController::class, 'tambah']);
        Route::post('/tambahfm', [FormController::class, 'create']);
        Route::get('/editfm/{id}', [FormController::class, 'edit']);
        Route::post('/editfm/{id}', [FormController::class, 'update']);
        Route::get('/hapusfm/{id}', [FormController::class, 'hapus']);
        Route::get('/hitung', [CountController::class, 'index'])->name('hitung');
        Route::post('/hitung', [CountController::class, 'index'])->name('hitung');
        Route::get('/detail/{id}', [CountController::class, 'detail']);
        Route::get('/dokumen/{id_mahasiswa}/{id_form}', [CountController::class, 'download'])->name('pdf.download');
        Route::get('/rank/{id}', [CountController::class, 'rank']);
    }
);

Route::group(
    ['middleware' => ['auth', 'checkrole:Admin,Pengelola']],
    function () {
        Route::get('/tentang', [DashboardController::class, 'about'])->name('tentang');
        Route::get('/kriteria', [CriteriaController::class, 'index'])->name('kriteria');
        Route::get('/sub', [SubController::class, 'index'])->name('sub');
        Route::get('/mahasiswa', [CollegeController::class, 'index'])->name('mahasiswa');
        Route::get('/formulir', [FormController::class, 'index'])->name('formulir');
        // Route::get('/download/file/{id:[0-9]+}', [CountController::class, 'download']);
        Route::post('/kuota', [CountController::class, 'kuota']);
        Route::get('/list', [CountController::class, 'list'])->name('list');
        Route::get('/list/detail/{id}', [CountController::class, 'sort']);
        Route::get('/hasil', [CountController::class, 'hasil'])->name('hasil');
        Route::get('/hasil/detail/{id}', [CountController::class, 'final']);
    }
);

Route::group(['middleware' => ['auth', 'checkrole:Admin,Pengelola,Mahasiswa']], function () {
    Route::get('/keluar', [AuthController::class, 'logout'])->name('logout');
    Route::get('/beranda', [DashboardController::class, 'index'])->name('beranda');
    Route::get('/profil', [ProfileController::class, 'index'])->name('profil');
    Route::post('/profil', [ProfileController::class, 'update']);
    Route::get('/pendaftaran', [RegisterController::class, 'index'])->name('pendaftaran');
    Route::get('/detail_/{id}', [RegisterController::class, 'detail']);
    Route::post('/daftarukt', [RegisterController::class, 'create']);
    Route::get('/hasilukt', [RegisterController::class, 'hasil']);
});
