<?php

namespace App\Http\Controllers\Api\Api_Raport;

use App\Http\Controllers\Controller;
use App\Http\Resources\Raport\Raport_Mbkm_Resource as RaportMbkn;
use App\Models\Model_raport\Raport_Mbkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RaportMbkmController extends Controller
{
     /**
     * index
     *
     * @return \Illuminate\Http\Response
     */
    public function dataRaportMbkm()
    {
        // Menggunakan eager loading untuk relasi
        $raport_mbkm = Raport_Mbkm::with(['siswa', 'semester', 'tahunAjaran'])->get();

        // Mengembalikan koleksi kehadiran sebagai resource
        return RaportMbkn::collection($raport_mbkm);
    }

       /**
     * Menampilkan data raport siswa berdasarkan ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $raport_mbkm = Raport_Mbkm::with(['siswa', 'kelas', 'semester', 'tahunAjaran',])->find($id);

        if (!$raport_mbkm) {
            return response()->json(['message' => 'Data raport tidak ditemukan'], 404);
        }

        Log::info('Data retrieved: ', ['id' => $id]);
        return new RaportMbkn($raport_mbkm);
    }
    
     /**
     * Menambah data raport siswa.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        Log::info('Request data Raport MBKM: ', $request->all());

        $validatedData = $request->validate([

            'id_siswa' => 'required|integer|exists:tbl_data_siswa,id',
            'id_kelas' => 'required|integer|exists:kelas,id',
            'id_semester' => 'required|integer|exists:semesters,id',
            'id_tahun_ajar' => 'required|integer|exists:tahun_ajarans,id',
            'judul_proyek' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'beriman' => 'required|in:BB,MB,BSH,SB',
            'berkebinakaan' => 'required|in:BB,MB,BSH,SB',
            'kreatif1' => 'required|in:BB,MB,BSH,SB',
            'kreatif2' => 'required|in:BB,MB,BSH,SB',
            'gotong_royong' => 'required|in:BB,MB,BSH,SB',
            'catatan_proses' => 'required|string|max:255',
        ]);

        Log::info('Validated data Raport MBKM: ', $validatedData);

        try {
            $raport_mbkm = Raport_Mbkm::create($validatedData);
            Log::info('Data Terkirim ke database: ', $raport_mbkm->toArray());
            return response()->json(new RaportMbkn($raport_mbkm), 201);
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
        $raport_mbkm = Raport_Mbkm::find($id);

        if (!$raport_mbkm) {
            return response()->json(['message' => 'Data raport tidak ditemukan'], 404);
        }

        Log::info('Request data: ', $request->all());

        $validatedData = $request->validate([
            'id_siswa' => 'required|integer|exists:tbl_data_siswa,id',
            'id_kelas' => 'required|integer|exists:kelas,id',
            'id_semester' => 'required|integer|exists:semesters,id',
            'id_tahun_ajar' => 'required|integer|exists:tahun_ajarans,id',
            'judul_proyek' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'beriman' => 'required|in:BB,MB,BSH,SB',
            'berkebinakaan' => 'required|in:BB,MB,BSH,SB',
            'kreatif1' => 'required|in:BB,MB,BSH,SB',
            'kreatif2' => 'required|in:BB,MB,BSH,SB',
            'gotong_royong' => 'required|in:BB,MB,BSH,SB',
            'catatan_proses' => 'required|string|max:255',
        ]);

        Log::info('Validated data: ', $validatedData);

        try {
            $raport_mbkm->update($validatedData);
            Log::info('Data updated: ', $raport_mbkm->toArray());
            return response()->json(new RaportMbkn($raport_mbkm));
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
        $raport_mbkm = Raport_Mbkm::find($id);

        if (!$raport_mbkm) {
            return response()->json(['message' => 'Data raport tidak ditemukan'], 404);
        }

        try {
            $raport_mbkm->delete();
            Log::info('Data deleted: ', ['id' => $id]);
            return response()->json(['message' => 'Data raport berhasil dihapus']);
        } catch (\Exception $e) {
            Log::error('Error: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal menghapus data', 'error' => $e->getMessage()], 500);
        }
    }
}
