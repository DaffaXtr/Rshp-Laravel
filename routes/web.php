<?php

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\site\SiteController;
use App\Http\Controllers\Admin\JenisHewanController;
use App\Http\Controllers\Admin\PemilikController;
use App\Http\Controllers\Admin\RasHewanController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\KategoriKlinisController;
use App\Http\Controllers\Admin\KodeTindakanTerapiController;
use App\Http\Controllers\Admin\PetController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;


Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/struktur', [HomeController::class, 'struktur'])->name('struktur');
Route::get('/layanan', [HomeController::class, 'layanan'])->name('layanan');
Route::get('/visi', [HomeController::class, 'visi'])->name('visi');

Route::get('/cek-koneksi', [SiteController::class, 'cekKoneksi'])->name('site.cekKoneksi');
Route::get('/site', [SiteController::class, 'index'])->name('site.index');

Route::get('/admin/jenis-hewan', [JenisHewanController::class, 'index'])->name('admin.jenis-hewan.index');
Route::get('/admin/pemilik', [PemilikController::class, 'index'])->name('admin.pemilik.index');
Route::get('/admin/ras-hewan', [RasHewanController::class, 'index'])->name('admin.ras-hewan.index');
Route::get('/admin/kategori', [KategoriController::class, 'index'])->name('admin.kategori.index');
Route::get('/admin/kategori-klinis', [KategoriKlinisController::class, 'index'])->name('admin.kategori-klinis.index');
Route::get('/admin/kode-tindakan-terapi', [KodeTindakanTerapiController::class, 'index'])->name('admin.kode-tindakan-terapi.index');
Route::get('/admin/pet', [PetController::class, 'index'])->name('admin.pet.index');
Route::get('/admin/role', [RoleController::class, 'index'])->name('admin.role.index');
Route::get('/admin/user', [UserController::class, 'index'])->name('admin.user.index');