<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Api\Api_Laporan\InventarisController;
use App\Http\Controllers\AsetController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DownloadContoller;
use App\Http\Controllers\EkskulController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\RaportController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\TPCPController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WaliController;

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

Route::get('admin/prestasi-list',[AdminController::class, 'prestasi'])->name('prestasi.index');

Route::post('admin/prestasi-create',[AdminController::class, 'createPrestasi'])->name('prestasi.create');


// guru & staff
Route::get('/admin-academic/teachers', [GuruController::class, 'index'])->name('index.guru');

Route::get('/admin-academic/teachers{id}', [GuruController::class, 'show'])->name('show.guru');

Route::get('/admin-academic/teachers/create', [GuruController::class, 'create'])->name('create.guru');

Route::post('/admin-academic/teachers/create', [GuruController::class, 'store'])->name('store.guru');

Route::get('/admin-academic/teacher/{id}/edit', [GuruController::class, 'edit'])->name('edit.guru');

Route::get('/admin-academic/teacher/{id}/update', [GuruController::class, 'update'])->name('update.guru');

Route::delete('/admin-academic/teacher/{id}', [GuruController::class, 'delete'])->name('destroy.guru');

//Walikelas
Route::get('/admin-academic/walikelas', [GuruController::class, 'walikelas'])->name('index.walikelas');
Route::post('/admin-academic/update-walikelas', [GuruController::class, 'updatewalikelas'])->name('update.walikelas');

Route::get('/check-walikelas/{id}', [GuruController::class, 'checkWalikelas']);




// siswa
Route::get('/admin-academic/students', [SiswaController::class, 'index'])->name('index.siswa');

Route::get('/admin-academic/students/class-{id_kelas}/siswa', [SiswaController::class, 'indexByKelas'])->name('index.siswa.kelas');

Route::get('/admin-academic/students/class/siswa{id}', [SiswaController::class, 'show'])->name('show.siswa');

Route::get('/admin-academic/student/siswa-{id}/edit', [SiswaController::class, 'edit'])->name('edit.siswa');

Route::get('/admin-academic/student/{id}/update', [SiswaController::class, 'update'])->name('update.siswa.admin');

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

Route::get('/admin-academic/report/akademik/siswa/{id}', [RaportController::class, 'showByAkademik'])->name('show.raport.akademik');

Route::get('/admin-academic/report/akademik/by-semester', [RaportController::class, 'showBySemester'])->name('show.raport.bysemester');

Route::get('/admin-academic/report/akademik-ekstrakurikuler', [RaportController::class, 'showEkstrakurikuler'])->name('show.raport.ekstrakurikuler');

Route::get('/admin-academic/report/mbkm/by-semester', [RaportController::class, 'showBySemesterMBKM'])->name('show.raport.BySemesterMbkm');

Route::get('/admin-academic/report/mbkm/siswa/{id}', [RaportController::class, 'showByMBKM'])->name('show.raport.mbkm');



// surat-menyurat
Route::get('/admin-letter/student-transfer', [SuratController::class, 'index_mutasi'],)->name('index.mutasi');

Route::get('/admin-letter/student-transfer/download', [SuratController::class, 'show_mutasi'],)->name('show.mutasi');

//laporan
Route::get('/admin-inventaris', [AsetController::class, 'index'])->name('index.inventaris');

Route::get('/admin-inventaris/harga', [AsetController::class, 'indekSatuanHarga'])->name('index.harga.satuan');


Route::post('/admin-inventaris/create/harga', [AsetController::class, 'createharga'])->name('create.harga.satuan');

Route::get('/admin-inventaris/create', [AsetController::class, 'create'])->name('create.inventaris');

Route::post('/admin-inventaris/create', [AsetController::class, 'store'])->name('store.inventaris');

Route::get('/admin-inventaris/aset/{id}/edit', [AsetController::class, 'edit'])->name('edit.inventaris');

Route::post('/inventaris/{id}', [AsetController::class, 'update'])->name('update.inventaris');


Route::delete('/inventaris/{id}', [AsetController::class, 'destroy'])->name('destroy.inventaris');


Route::get('/admin-Laporan-Keuangan', [KeuanganController::class, 'index'])->name('index.keuangan');

Route::get('/admin-Laporan-Keuangan/create', [KeuanganController::class, 'create'])->name('create.keuangan');

Route::get('/admin-Laporan-Keuangan/rencana', [KeuanganController::class, 'rencana'])->name('index.rencana');

Route::get('/admin-Laporan-perencanaan/create', [KeuanganController::class, 'createRencana'])->name('create.rencana');

Route::post('/admin-Laporan-perencanaan/store', [KeuanganController::class, 'storeRencana'])->name('store.rencana');


Route::get('/admin-Laporan-pengunaan', [KeuanganController::class, 'indexPenggunaan'])->name('index.pengunaan.dana');

Route::get('/admin-view-pengunaan-dana', [KeuanganController::class, 'viewPenggunaan'])->name('view.penggunaan.dana');

Route::get('/dana/{id}', [KeuanganController::class, 'showRencana'])->name('dana.show');

Route::post('/admin-Laporan-Keuangan/create', [KeuanganController::class, 'store'])->name('store.keuangan');


// akun routes

Route::get('/admin-account/create-account', [AdminController::class, 'createAkun'])->name('create.akun');

Route::post('/admin-account/create', [AdminController::class, 'storeAkun'])->name('store.akun');

Route::get('/admin-account/show', [AdminController::class, 'showAkun'])->name('show.akun.admin');

Route::get('/user-account/show', [UserController::class, 'show'])->name('show.akun.user');

// end admin routes

/////////////////////////////////////////////////////////////////////////////////////////////////////////

// user routes
Route::get('/user-home', [UserController::class, 'index'])->name('index.user');

// input tpcp

Route::get('/user-academic/tpcp', [TPCPController::class,'index'])->name('index.tpcp');

Route::get('/user-academic/input-tpcp/{id}', [TPCPController::class,'add'])->name('index.input.tpcp');

Route::get('/user-academic/input-tpcp', [TPCPController::class, 'FilterTpcp'])->name('show.tpcp.byFilter');

Route::post('/user-academic/store-tpcp', [TPCPController::class,'store'])->name('store.tpcp');

Route::get('/user-academic/edit-tpcp{id}', [TPCPController::class,'EditTpcp'])->name('edit.tpcp');

Route::put('/user-academic/update-tpcp/{id}', [TPCPController::class,'UpdateTpcp'])->name('update.tpcp');



// input nilai & raport akademik

Route::get('/user-academic/input-akademik', [NilaiController::class,'indexByAkademik'])->name('index.input.akademik');

Route::get('/user-academic/akademik', [NilaiController::class,'index'])->name('index.akademik');
// routes/web.php

Route::get('/user-academic/input-akademik/siswa-by-kelas', [NilaiController::class, 'filterSiswa'])->name('filter.siswa');

Route::post('/user-academic/input-akademik/siswa-by-kelas', [NilaiController::class, 'store'])->name('store.nilai.akademik');

Route::put('/user-academic/edit-nilai-akademik/edit', [NilaiController::class, 'EditNilaiAkademik'])->name('edit.nilai.akademik');



/* 
Route::get('/user-academic/input-ekskul', [NilaiController::class,'indexByEkskul'])->name('index.input.ekskul');

Route::get('/user-academic/input-ekskul/siswa-by-kelas', [NilaiController::class, 'filterekskul'])->name('filter.ekskul'); */

Route::get('/user-academic/input-ekskul', [NilaiController::class, 'FilterAll'])->name('show.ekskul.byFilter');

Route::post('/user-academic/input-ekskul/nilai', [NilaiController::class, 'StoreEkskul'])->name('store.nilai.ekskul');

// Route::get('/user-academic/edit-ekskul/{id}/nilai', [NilaiController::class, 'EditEkskul'])->name('edit.nilai.ekskul');
Route::post('/user-academic/update-ekskul/nilai', [NilaiController::class, 'UpdateEkskul'])->name('update.nilai.ekskul');

Route::delete('/delete-nilai-ekskul-siswa/{id}', [NilaiController::class, 'destroy']);



Route::get('/user-academic/input-raport-akademik', [RaportController::class,'inputByAkademik'])->name('input.raport.akademik');

Route::get('/user-academic/input-raport-akademik/class-{id_kelas}/siswa', [RaportController::class, 'inputByKelas'])->name('input.raport.kelas');

Route::get('/user-academic/input-raport-akademik/siswa/{id}', [RaportController::class, 'showRaport'])->name('show.raport.siswa');

Route::put('/user-academic/update-kelas-siswa/siswa', [RaportController::class, 'submitRaport'])->name('update.kelas.siswa');

Route::get('/user-academic/input-raport/siswa-by-kelas', [RaportController::class, 'filterRaport'])->name('filter.raport');

Route::get('/admin-academic/input-raport-akademik/by-semester', [RaportController::class, 'showBySemester'])->name('show.raport.filter');

Route::post('/admin-academic/input-kehadiran', [RaportController::class, 'storeKehadiran'])->name('store.kehadiran');





// input nilai & raport mbkm

Route::get('/user-mbkm/input-mbkm', [NilaiController::class, 'indexByMBKM'])->name('index.input.p5');

Route::get('/user-mbkm/input-mbkm', [NilaiController::class, 'FilterProject'])->name('show.project.byFilter');

// Route::post('/user-mbkm/input-mbkm/create', [NilaiController::class, 'storeProject'])->name('store.value');

// Route::post('/user-mbkm/input-mbkm/create-judul', [NilaiController::class, 'storeJudulRaportMBKM'])->name('store.raport.mbkm');

Route::post('/user-mbkm/input-nilai-mbkm/create', [NilaiController::class, 'storeNilai'])->name('store.nilai.project');

Route::put('/user-mbkm/edit-nilai-mbkm/edit', [NilaiController::class, 'EditNilai'])->name('edit.nilai.project');

Route::get('/user-mbkm/input-p5', [RaportController::class,'inputByProjek'])->name('index.p5');

Route::get('/user-mbkm/p5/create', [RaportController::class, 'createByProjek'])->name('create.p5');


Route::post('/user-mbkm/p5/create', [RaportController::class, 'storeProject'])->name('store.p5');

Route::put('/user-mbkm/projects/{id}', [RaportController::class, 'updateProject'])->name('update.project.p5');

Route::delete('/user-mbkm/projects/{id}', [RaportController::class, 'destroyProject'])->name('delete.project.p5');

Route::get('/user-mbkm/input-raport-mbkm', [RaportController::class,'inputByMBKM'])->name('index.input.mbkm');



// end user routes


// Wali Murid routes
//////////////////////////////////////////////
Route::prefix('wali')->group(function () {
    Route::get('/home', [WaliController::class, 'index'])->name('index.wali');
    Route::get('/prestasi-list', [WaliController::class, 'prestasi'])->name('prestasi.index.wali');
    Route::get('/detail-akun', [WaliController::class, 'DetailAkun'])->name('detail.index.wali');
    Route::get('/edit-akun{id}', [WaliController::class, 'EditAkun'])->name('edit.wali');
    Route::get('/update-akun{id}', [WaliController::class, 'UpdateAkun'])->name('update.siswa');
    Route::get('/ganti-pw', [WaliController::class, 'GantiPw'])->name('ganti.pw.wali');
    Route::put('/update-pw', [WaliController::class, 'updatePw'])->name('updatePw.wali');
});
Route::prefix('Raport')->group(function () {
    Route::get('/siswa-akademik', [WaliController::class, 'RaportAkademik'])->name('wali.raport.akademik');
    Route::get('/siswa-proyek', [WaliController::class, 'RaportProyek'])->name('wali.raport.proyek');
   
});


//PRINT ROUTES


Route::prefix('download')->group(function () {
    Route::get('/data-guru', [DownloadContoller::class, 'downloadGuru'])->name('download.data.guru');
    Route::get('/detail-guru/{id}', [DownloadContoller::class, 'downloadDetailGuru'])->name('download.detail.guru');
    Route::get('/data-siswa/{id}', [DownloadContoller::class, 'downloadSiswa'])->name('download.data.siswa');
    Route::get('/detail-siswa/{id}', [DownloadContoller::class, 'downloadDetailiswa'])->name('download.detail.siswa');
    Route::get('/data-mapel', [DownloadContoller::class, 'downloadMapel'])->name('download.data.mapel');
    Route::get('/data-ekskul', [DownloadContoller::class, 'downloadEkskul'])->name('download.data.ekskul');
    Route::get('/data-aset', [DownloadContoller::class, 'downloadAset'])->name('download.data.aset');
    Route::get('/data-keuangan', [DownloadContoller::class, 'downloadkeuangan'])->name('download.data.keuangan');
    Route::get('/data-perencanaan{id}', [DownloadContoller::class, 'downloadPerencanaan'])->name('download.data.perencanaan');
    Route::get('/data-raport-akademik{id}', [DownloadContoller::class, 'downloadAkadmik'])->name('download.data.raport.akademik');
    Route::get('/data-raport-mbkm{id}', [DownloadContoller::class, 'downloadMbkm'])->name('download.data.raport.mbkm');
    Route::get('/data-tpcp{idKelas}/{idSemester}', [DownloadContoller::class, 'downloadTpcp'])->name('download.data.tpcp');
    Route::get('/data-kelas', [DownloadContoller::class, 'downloadkelas'])->name('download.data.kelas');
    Route::get('/data-prestasi', [DownloadContoller::class, 'downloadprestasi'])->name('download.data.prestasi');
    Route::get('/data-harga-satuan-barang', [DownloadContoller::class, 'downloadharga'])->name('download.data.hargasatuan');
    Route::get('/data-penggunaan-dana{id}', [DownloadContoller::class, 'downloadpenggunaandana'])->name('download.penggunaan.dana');

});



