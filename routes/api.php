<?php

use App\Http\Controllers\Api\Api_Laporan\InventarisController;
use App\Http\Controllers\Api\Api_Laporan\LaporanKeuanganController;
use App\Http\Controllers\Api\Api_Raport\RaportEkstrakulikulerController;
use App\Http\Controllers\Api\Api_Raport\RaportMbkmController;
use App\Http\Controllers\Api\Api_Raport\RaportSiswaController;
use App\Http\Controllers\Api\Api_Siswa\DataSiswaController;
use App\Http\Controllers\Api\Api_Siswa\EkstrakulikulerController;
use App\Http\Controllers\Api\Api_Siswa\JadwalMapelController;
use App\Http\Controllers\Api\Api_Siswa\KehadiranController;
use App\Http\Controllers\Api\Api_Siswa\KelasController;
use App\Http\Controllers\Api\Api_Siswa\MapelController;
use App\Http\Controllers\Api\Api_Siswa\Tahun_ajar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DataGuruController;
use App\Http\Controllers\Api_Surat\SuratTugas;

/*
|---------------------------------------------------------------------------------------------|
                                    API Data Guru                           
|---------------------------------------------------------------------------------------------|
*/
        Route::group(['prefix' => 'guru'], function () {   
            Route::get('/', [DataGuruController::class, 'dataGuru']);
            Route::get('//{id}', [DataGuruController::class, 'show']);
            Route::post('/', [DataGuruController::class, 'store']);
            Route::put('//{id}', [DataGuruController::class, 'update']);
            Route::delete('//{id}', [DataGuruController::class, 'destroy']);
        });

 /*
|---------------------------------------------------------------------------------------------|
                                    API Data Siswa                           
|---------------------------------------------------------------------------------------------|
*/
        Route::group(['prefix' => 'siswa'], function () {  
            Route::get('/', [DataSiswaController::class,'dataSiswa']);
            Route::get('/{id}', [DataSiswaController::class, 'show']);
            Route::post('/', [DataSiswaController::class, 'store']);
            Route::put('/{id}', [DataSiswaController::class, 'update']);
            Route::delete('//{id}', [DataSiswaController::class, 'destroy']);

        });

// Define route for Data Siswa
Route::group(['prefix' => 'pelajaran'], function () {  
    Route::get('/', [MapelController::class,'dataMapel']);
    Route::get('/{id}', [MapelController::class, 'show']);
    Route::post('/', [MapelController::class, 'store']);
    Route::put('/{id}', [MapelController::class, 'update']);
    Route::delete('/{id}', [MapelController::class, 'destroy']);
 });
Route::group(['prefix' => 'kelas'], function () {  
    Route::get('/', [KelasController::class,'datakelas']);
    Route::get('/{id}', [KelasController::class, 'show']);
    Route::post('/', [KelasController::class, 'store']);
    Route::put('/{id}', [KelasController::class, 'update']);
    Route::delete('/{id}', [KelasController::class, 'destroy']);
 });
Route::group(['prefix' => 'kehadiran'], function () {  
    Route::get('/', [KehadiranController::class,'dataKehadiran']);
    Route::get('/{id}', [KehadiranController::class, 'show']);
    Route::post('/', [KehadiranController::class, 'store']);
    Route::put('/{id}', [KehadiranController::class, 'update']);
    Route::delete('/{id}', [KehadiranController::class, 'destroy']);
 });
Route::group(['prefix' => 'jadwal'], function () { 
    Route::get('/', [JadwalMapelController::class,'dataJadwalPelajaran']);
    Route::get('/{id}', [JadwalMapelController::class, 'show']);
    Route::post('/', [JadwalMapelController::class, 'store']);
    Route::put('/{id}', [JadwalMapelController::class, 'update']);
    Route::delete('/{id}', [JadwalMapelController::class, 'destroy']);
  });

 /*
|---------------------------------------------------------------------------------------------|
                                    API Data Ekstrakulikuler                           
|---------------------------------------------------------------------------------------------|
*/
Route::group(['prefix' => 'extrakulikuler'], function () {  
    Route::get('/', [EkstrakulikulerController::class,'dataListExtraculicular']);
    Route::get('//{id}', [EkstrakulikulerController::class, 'show']);
    Route::post('/', [EkstrakulikulerController::class, 'store']);
    Route::put('//{id}', [EkstrakulikulerController::class, 'update']);
    Route::delete('//{id}', [EkstrakulikulerController::class, 'destroy']);
 });

/*
|---------------------------------------------------------------------------------------------|
                                    API Routes Tahun ajaran                           
|---------------------------------------------------------------------------------------------|
*/
    Route::group(['prefix' => 'tahunajar'], function () {
        Route::get('/', [Tahun_ajar::class, 'index']);
        Route::get('/{id}', [Tahun_ajar::class, 'show']);
        Route::post('/', [Tahun_ajar::class, 'store']);
        Route::put('/{id}', [Tahun_ajar::class, 'update']); 
        Route::delete('/{id}', [Tahun_ajar::class, 'destroy']);
    });


/*
|--------------------------------------------------------------------------|
                        API Routes LAPORAN                              
|--------------------------------------------------------------------------|
*/
    Route::prefix('laporan')->group(function () {

         // ----- LAPORAN KEUANGAN ------ //
        Route::prefix('keuangan')->group(function () {   

            Route::get('/', [LaporanKeuanganController::class,'dataLaporanKeuangan']);
            Route::get('/{id}', [LaporanKeuanganController::class, 'show']);
            Route::post('/', [LaporanKeuanganController::class, 'store']);
            Route::put('/{id}', [LaporanKeuanganController::class, 'update']);
            Route::delete('/{id}', [LaporanKeuanganController::class, 'destroy']);
         });

         // ----- LAPORAN INVENTARIS ------ //
         Route::prefix('inventaris')->group(function () {   
            
            Route::get('/', [InventarisController::class, 'dataInventaris']);
            Route::get('/{id}', [InventarisController::class, 'show']);
            Route::post('/', [InventarisController::class, 'store']);
            Route::put('/{id}', [InventarisController::class, 'update']);
            Route::delete('/{id}', [InventarisController::class, 'destroy']);
          });
    });


/*
|---------------------------------------------------------------------------------------------|
                                     API Routes RAPORT                             
|---------------------------------------------------------------------------------------------|
*/
Route::prefix('raport')->group(function () {
    
    // ----- RAPORT SISWA ------ //
    Route::prefix('siswa')->group(function () {
        Route::get('/',[ RaportSiswaController::class,'dataRaportSiswa']);
        Route::get('/{id}', [RaportSiswaController::class, 'show']);
        Route::post('/', [RaportSiswaController::class, 'store']);
        Route::put('/{id}', [RaportSiswaController::class, 'update']);
        Route::delete('/{id}', [RaportSiswaController::class, 'destroy']);
    });

    // ----- RAPORT MBKS ------ //
    Route::prefix('mbkm')->group(function () { 
        Route::get('/', [RaportMbkmController::class,'dataRaportMbkm']);
        Route::get('/{id}', [RaportMbkmController::class, 'show']);
        Route::post('/', [RaportMbkmController::class, 'store']);
        Route::put('/{id}', [RaportMbkmController::class, 'update']);
        Route::delete('/{id}', [RaportMbkmController::class, 'destroy']);
    });
    // ----- RAPORT EXTRACULICULAR ------ //
    Route::prefix('ekstrakulikuler')->group(function () { 
        Route::get('/', [RaportEkstrakulikulerController::class,'dataRaportExtraculicular']);
        Route::get('/{id}', [RaportEkstrakulikulerController::class, 'show']);
        Route::post('/', [RaportEkstrakulikulerController::class, 'store']);
        Route::put('/{id}', [RaportEkstrakulikulerController::class, 'update']);
        Route::delete('/{id}', [RaportEkstrakulikulerController::class, 'destroy']);
    });

});

/*
|---------------------------------------------------------------------------------------------|
                                     API Routes SURAT                            
|---------------------------------------------------------------------------------------------|
*/

Route::group(['prefix' => 'surat'], function () {  
    Route::group(['prefix' => 'tugas'], function () {  
        Route::get('/', [SuratTugas::class,'dataListExtraculicular']);
        Route::get('//{id}', [EkstrakulikulerController::class, 'show']);
        Route::post('/', [EkstrakulikulerController::class, 'store']);
        Route::put('//{id}', [EkstrakulikulerController::class, 'update']);
        Route::delete('//{id}', [EkstrakulikulerController::class, 'destroy']);
     });
   
 });

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
