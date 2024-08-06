<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Api\Api_Laporan\InventarisController;
use App\Http\Controllers\AsetController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EkskulController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\RaportController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\TPCPContoller;
use App\Http\Controllers\UserController;

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

// Route::get('/editing', function () {
//     return view('admin.editing');
// });

// auth routes
Route::get('/', [AuthController::class, 'index'])->name('auth');

Route::post('/', [AuthController::class, 'authenticate']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



// end auth routes

// admin routes

// kalender
Route::get('/admin-home', [AdminController::class, 'index'])->name('index.kalender');

Route::get('/admin-home/create', [AdminController::class, 'create'])->name('create.kalender');

Route::post('/admin-home/create', [AdminController::class, 'store'])->name('store.kalender');


// guru & staff
Route::get('/admin-academic/teachers', [GuruController::class, 'index'])->name('index.guru');

Route::get('/admin-academic/teachers{id}', [GuruController::class, 'show'])->name('show.guru');

Route::get('/admin-academic/teachers/create', [GuruController::class, 'create'])->name('create.guru');

Route::post('/admin-academic/teachers/create', [GuruController::class, 'store'])->name('store.guru');

Route::get('/admin-academic/teacher/{id}/edit', [GuruController::class, 'edit'])->name('edit.guru');

Route::get('/admin-academic/teacher/{id}/update', [GuruController::class, 'update'])->name('update.guru');

Route::delete('/admin-academic/teacher/{id}', [GuruController::class, 'delete'])->name('destroy.guru');



// siswa
Route::get('/admin-academic/students', [SiswaController::class, 'index'])->name('index.siswa');

Route::get('/admin-academic/students/class-{id_kelas}/siswa', [SiswaController::class, 'indexByKelas'])->name('index.siswa.kelas');

Route::get('/admin-academic/students/class/siswa{id}', [SiswaController::class, 'show'])->name('show.siswa');

Route::get('/admin-academic/student/siswa{id}/edit', [SiswaController::class, 'edit'])->name('edit.siswa');

Route::get('/admin-academic/student/{id}/edit', [SiswaController::class, 'update'])->name('update.siswa');

Route::get('/admin-academic/students/create', [SiswaController::class, 'create'])->name('create.siswa');

Route::post('/admin-academic/students/create', [SiswaController::class, 'store'])->name('store.siswa');

Route::delete('/admin-academic/student/{id}', [SiswaController::class, 'delete'])->name('destroy.siswa');


// mapel
Route::get('/admin-academic/subjects', [MapelController::class, 'index'])->name('index.mapel');

Route::get('/admin-academic/subjects/show', [MapelController::class, 'show'])->name('show.mapel');

Route::get('/admin-academic/subjects/create', [MapelController::class, 'create'])->name('create.mapel');

Route::post('/admin-academic/subjects/create', [MapelController::class, 'store'])->name('store.mapel');

Route::get('/admin-academic/subject/{id}/edit', [MapelController::class, 'edit'])->name('edit.mapel');

Route::post('/admin-academic/subject/{id}/update', [MapelController::class, 'update'])->name('update.mapel');

Route::delete('/admin-academic/subject/{id}', [MapelController::class, 'delete'])->name('destroy.mapel');


// ekskul
Route::get('/admin-academic/extracurriculars', [EkskulController::class, 'index'])->name('index.ekskul');

Route::get('/admin-academic/extracurriculars/show', [EkskulController::class, 'show'])->name('show.ekskul');

Route::get('/admin-academic/extracurriculars/create', [EkskulController::class, 'create'])->name('create.ekskul');

Route::post('/admin-academic/extracurriculars/create', [EkskulController::class, 'store'])->name('store.ekskul');

Route::get('/admin-academic/extracurricular/{id}/edit', [EkskulController::class, 'edit'])->name('edit.ekskul');

Route::post('/admin-academic/extracurricular/{id}/update', [EkskulController::class, 'update'])->name('update.ekskul');

Route::delete('/admin-academic/extracurricular/{id}', [EkskulController::class, 'delete'])->name('destroy.ekskul');


// raport
Route::get('/admin-academic/reports', [RaportController::class, 'index'])->name('index.raport');

Route::get('/admin-academic/reports/class-{id_kelas}/siswa', [RaportController::class, 'indexByKelas'])->name('index.raport.kelas');

Route::get('/admin-academic/report/akademik/siswa/{id_siswa}', [RaportController::class, 'showByAkademik'])->name('show.raport.akademik');

Route::get('/admin-academic/report/akademik/by-semester', [RaportController::class, 'showBySemester'])->name('show.raport.bysemester');

Route::get('/admin-academic/report/akademik-ekstrakurikuler', [RaportController::class, 'showEkstrakurikuler'])->name('show.raport.ekstrakurikuler');

Route::get('/admin-academic/report/mbkm/by-semester', [RaportController::class, 'showBySemesterMBKM'])->name('show.raport.BySemesterMbkm');

Route::get('/admin-academic/report/mbkm/siswa/{id_siswa}', [RaportController::class, 'showByMBKM'])->name('show.raport.mbkm');



// surat-menyurat
Route::get('/admin-letter/student-transfer', [SuratController::class, 'index_mutasi'],)->name('index.mutasi');

Route::get('/admin-letter/student-transfer/download', [SuratController::class, 'show_mutasi'],)->name('show.mutasi');

//laporan
Route::get('/admin-inventaris', [AsetController::class, 'index'])->name('index.inventaris');

Route::get('/admin-inventaris/create', [AsetController::class, 'create'])->name('create.inventaris');

Route::post('/admin-inventaris/create', [AsetController::class, 'store'])->name('store.inventaris');

Route::get('/admin-inventaris/aset/{id}/edit', [AsetController::class, 'edit'])->name('edit.inventaris');

Route::post('/inventaris/{id}', [AsetController::class, 'update'])->name('update.inventaris');


Route::delete('/inventaris/{id}', [AsetController::class, 'destroy'])->name('destroy.inventaris');


Route::get('/admin-Laporan-Keuangan', [KeuanganController::class, 'index'])->name('index.keuangan');

Route::get('/admin-Laporan-Keuaangan/create', [KeuanganController::class, 'create'])->name('create.keuangan');

Route::post('/admin-Laporan-Keuaangan/create', [KeuanganController::class, 'store'])->name('store.keuangan');


// akun routes

Route::get('/admin-account/create-account', [AdminController::class, 'createAkun'])->name('create.akun');

Route::post('/admin-account/create', [AdminController::class, 'storeAkun'])->name('store.akun');

Route::get('/admin-account/show', [AdminController::class, 'showAkun'])->name('show.akun');

Route::get('/user-account/show', [UserController::class, 'show'])->name('show.akun');

// end admin routes

/////////////////////////////////////////////////////////////////////////////////////////////////////////

// user routes
Route::get('/user-home', [UserController::class, 'index'])->name('index.user');

// input tpcp

Route::get('/user-academic/input-tpcp', [TPCPContoller::class,'indexByTPCP'])->name('index.input.tpcp');

// input nilai & raport akademik

Route::get('/user-academic/input-akademik', [NilaiController::class,'indexByAkademik'])->name('index.input.akademik');

Route::get('/user-academic/input-ekskul', [NilaiController::class,'indexByEkskul'])->name('index.input.ekskul');

Route::get('/user-academic/input-raport-akademik', [RaportController::class,'inputByAkademik'])->name('input.raport.akademik');

// input nilai & raport mbkm

Route::get('/user-mbkm/input-mbkm', [NilaiController::class, 'indexByMBKM'])->name('index.input.p5');

Route::get('/user-mbkm/input-p5', [RaportController::class,'inputByProjek'])->name('index.p5');

Route::get('/user-mbkm/input-raport-mbkm', [RaportController::class,'inputByMBKM'])->name('index.input.mbkm');



// end user routes
