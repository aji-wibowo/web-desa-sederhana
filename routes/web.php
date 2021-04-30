<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('/layanan')->group(function () {
    // route for layanan ktp
    Route::get('/ktp', [App\Http\Controllers\HomeController::class, 'form_ktp'])->name('layanan_ktp')->middleware('auth', 'checkrole:warga');
    Route::post('/ktp/process', [App\Http\Controllers\HomeController::class, 'form_ktp_process'])->name('layanan_ktp_proses')->middleware('auth', 'checkrole:warga');
    // route for layanan kk
    Route::get('/kk', [App\Http\Controllers\HomeController::class, 'form_kk'])->name('layanan_kk')->middleware('auth', 'checkrole:warga');
    Route::post('/kk/process', [App\Http\Controllers\HomeController::class, 'form_kk_process'])->name('layanan_kk_proses')->middleware('auth', 'checkrole:warga');
    // route for layanan surat_pindah_datang_wni
    Route::get('/pindah/datang', [App\Http\Controllers\HomeController::class, 'form_surat_pindah'])->name('layanan_surat_pindah')->middleware('auth', 'checkrole:warga');
    Route::post('/pindah/datang/process', [App\Http\Controllers\HomeController::class, 'form_surat_pindah_process'])->name('layanan_pindah_datang_proses')->middleware('auth', 'checkrole:warga');
});

// route for tentang desa
Route::get('/tentang', [App\Http\Controllers\HomeController::class, 'tentang'])->name('tentang');
Route::get('/strukturorganisasi', [App\Http\Controllers\HomeController::class, 'struktur_organisasi'])->name('struktur_organisasi');
// route for rukun warga
Route::get('/rukunwarga', [App\Http\Controllers\HomeController::class, 'rukun_warga_user'])->name('rukun_warga_user');
// route for hubungi kami
Route::get('/hubungikami', [App\Http\Controllers\HomeController::class, 'form_hubungi_kami'])->name('hubungi_kami');
Route::post('/hubungikami/proses', [App\Http\Controllers\HomeController::class, 'form_hubungi_kami_process'])->name('hubungi_kami_proses');
// route for myaccount user
Route::get('/myaccount', [App\Http\Controllers\HomeController::class, 'myaccount_user'])->name('myaccount_user')->middleware('auth', 'checkrole:warga');
Route::post('/myaccount/proses', [App\Http\Controllers\HomeController::class, 'myaccount_user_proses'])->name('myaccount_user_proses')->middleware('auth', 'checkrole:warga');;

Route::prefix('/admin')->group(function () {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin')->middleware('auth', 'checkrole:admin');
    Route::get('/pelayanan', [App\Http\Controllers\AdminController::class, 'pelayanan'])->name('pelayanan_admin')->middleware('auth', 'checkrole:admin');
    Route::get('/pelayanan/verifikasi/{id}', [App\Http\Controllers\AdminController::class, 'pelayanan_verifikasi'])->name('pelayanan_admin_verifikasi')->middleware('auth', 'checkrole:admin');
    Route::get('/pelayanan/dapatdiambil/{id}', [App\Http\Controllers\AdminController::class, 'pelayanan_dapatdiambil'])->name('pelayanan_admin_dapatdiambil')->middleware('auth', 'checkrole:admin');
    Route::get('/pelayanan/sudahdiambil/{id}', [App\Http\Controllers\AdminController::class, 'pelayanan_sudahdiambil'])->name('pelayanan_admin_sudahdiambil')->middleware('auth', 'checkrole:admin');
    Route::get('/pelayanan/tolak/{id}', [App\Http\Controllers\AdminController::class, 'pelayanan_tolak'])->name('pelayanan_admin_tolak')->middleware('auth', 'checkrole:admin');
    Route::get('/rukunwarga', [App\Http\Controllers\AdminController::class, 'list_rukun_warga'])->name('rukun_warga')->middleware('auth', 'checkrole:admin');
    Route::post('/rukunwarga/tambah/proses', [App\Http\Controllers\AdminController::class, 'tambah_rukun_warga_proses'])->name('rukun_warga_tambah_proses')->middleware('auth', 'checkrole:admin');
    Route::post('/rukunwarga/ubah/proses/{id}', [App\Http\Controllers\AdminController::class, 'ubah_rukun_warga_proses'])->name('rukun_warga_ubah_proses')->middleware('auth', 'checkrole:admin');
    Route::get('/rukunwarga/hapus/proses/{id}', [App\Http\Controllers\AdminController::class, 'delete_rukun_warga_proses'])->name('rukun_warga_admin_delete')->middleware('auth', 'checkrole:admin');
    Route::get('/users', [App\Http\Controllers\AdminController::class, 'list_user'])->name('list_user')->middleware('auth', 'checkrole:admin');
    Route::get('/myaccount', [App\Http\Controllers\AdminController::class, 'my_account'])->name('profil_admin')->middleware('auth', 'checkrole:admin');
    Route::post('/myaccount/proses', [App\Http\Controllers\AdminController::class, 'my_account_proses'])->name('profil_admin_proses')->middleware('auth', 'checkrole:admin');
});
