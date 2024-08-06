<?php

namespace App\Http\Controllers\Api\Api_Siswa;

use App\Http\Controllers\Controller;
use App\Http\Resources\Data\Siswa\Kehadiran_Resource;
use App\Models\Model_data_siswa\Kehadiran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class KehadiranController extends Controller
{
    /**
     * index
     *
     * @return \Illuminate\Http\Response
     */
    public function dataKehadiran()
    {
        // Menggunakan eager loading untuk relasi
        $kehadirans = Kehadiran::with(['siswa', 'semester', 'tahunAjaran','kelas'])->get();

        // Mengembalikan koleksi kehadiran sebagai resource
        return Kehadiran_Resource::collection($kehadirans);
    }
    
     /**
     * Menampilkan data raport siswa berdasarkan ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $kehadirans = Kehadiran::with(['siswa', 'semester', 'tahunAjaran','kelas'])->find($id);

        if (!$kehadirans) {
            return response()->json(['message' => 'Data raport tidak ditemukan'], 404);
        }

        Log::info('Data retrieved: ', ['id' => $id]);
        return new Kehadiran_Resource($kehadirans);
    }
     /**
     * Menambah data raport siswa.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        Log::info('Request data kehadiran : ', $request->all());

        $validatedData = $request->validate([
            'id_siswa' =>'required|integer|exists:tbl_data_siswa,id',
            'id_kelas' => 'required|integer|exists:kelas,id',
            'id_semester' => 'required|integer|exists:semesters,id',
            'id_tahun_ajar' => 'required|integer|exists:tahun_ajarans,id',
            'sakit' => 'required|string',
            'izin' => 'required|string',
            'alpha' => 'required|string',
        ]);

        Log::info('Validated data: ', $validatedData);

        try {
            $kehadirans = Kehadiran::create($validatedData);
            Log::info('Data stored: ', $kehadirans->toArray());
            return response()->json(new Kehadiran_Resource($kehadirans), 201);
        } catch (\Exception $e) {
            Log::error('Error: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal menyimpan data', 'error' => $e->getMessage()], 500);
        }
    }
   /**
     * Mengubah data raport siswa berdasarkan ID.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $kehadirans = Kehadiran::find($id);

        if (!$kehadirans) {
            return response()->json(['message' => 'Data raport tidak ditemukan'], 404);
        }

        Log::info('Request data: ', $request->all());

        $validatedData = $request->validate([

            'id_siswa' =>'required|integer|exists:tbl_data_siswa,id',
            'id_kelas' => 'required|integer|exists:kelas,id',
            'id_semester' => 'required|integer|exists:semesters,id',
            'id_tahun_ajar' => 'required|integer|exists:tahun_ajarans,id',
            'sakit' => 'required|string',
            'izin' => 'required|string',
            'alpha' => 'required|string',
        ]);

        Log::info('Validated data: ', $validatedData);

        try {
            $kehadirans->update($validatedData);
            Log::info('Data updated: ', $kehadirans->toArray());
            return response()->json(new Kehadiran_Resource($kehadirans));
        } catch (\Exception $e) {
            Log::error('Error: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal memperbarui data', 'error' => $e->getMessage()], 500);
        }
    }

   /**
     * Menghapus data raport siswa berdasarkan ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $kehadirans = Kehadiran::find($id);

        if (!$kehadirans) {
            return response()->json(['message' => 'Data raport tidak ditemukan'], 404);
        }

        try {
            $kehadirans->delete();
            Log::info('Data deleted: ', ['id' => $id]);
            return response()->json(['message' => 'Data raport berhasil dihapus']);
        } catch (\Exception $e) {
            Log::error('Error: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal menghapus data', 'error' => $e->getMessage()], 500);
        }
    }
}
