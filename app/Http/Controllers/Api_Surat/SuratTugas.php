<?php

namespace App\Http\Controllers\Api_Surat;

use App\Http\Controllers\Controller;
use App\Http\Resources\Surat\SuratTugas as Surat_Tugas;
use App\Models\Model_Surat\SuratTugas as ModelSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SuratTugas extends Controller
{
    
     /**
     * index
     *
     * @return \Illuminate\Http\Response
     */
    public function SuratTugas()
    {
        // Menggunakan eager loading untuk relasi
        $surat_tugas = ModelSurat::with(['guru'])->get();

        // Mengembalikan koleksi kehadiran sebagai resource
        return Surat_Tugas::collection($surat_tugas);
    }

    
     /**
     * Menampilkan data raport siswa berdasarkan ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $surat_tugas = ModelSurat::with(['guru'])->find($id);

        if (!$surat_tugas) {
            return response()->json(['message' => 'Data raport tidak ditemukan'], 404);
        }

        Log::info('Data retrieved: ', ['id' => $id]);
        return new Surat_Tugas($surat_tugas);
    }
     /**
     * Menambah data raport siswa.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        Log::info('Request data Surat Tugas: ', $request->all());

        $validatedData = $request->validate([
            'id_guru' => 'required|integer|exists:tbl_guru,id',
            'tujuan_penugasan' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            
        ]);

        Log::info('Validated data: ', $validatedData);

        try {
            $surat_tugas = ModelSurat::create($validatedData);
            Log::info('Data stored: ', $surat_tugas->toArray());
            return response()->json(new Surat_Tugas($surat_tugas), 201);
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
        $surat_tugas = ModelSurat::find($id);

        if (!$surat_tugas) {
            return response()->json(['message' => 'Data raport tidak ditemukan'], 404);
        }

        Log::info('Request data: ', $request->all());

        $validatedData = $request->validate([
            'id_guru' => 'required|integer|exists:tbl_guru,id',
            'tujuan_penugasan' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
        ]);

        Log::info('Validated data: ', $validatedData);

        try {
            $surat_tugas->update($validatedData);
            Log::info('Data updated: ', $surat_tugas->toArray());
            return response()->json(new Surat_Tugas($surat_tugas));
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
        $surat_tugas = ModelSurat::find($id);

        if (!$surat_tugas) {
            return response()->json(['message' => 'Data raport tidak ditemukan'], 404);
        }

        try {
            $surat_tugas->delete();
            Log::info('Data deleted: ', ['id' => $id]);
            return response()->json(['message' => 'Data raport berhasil dihapus']);
        } catch (\Exception $e) {
            Log::error('Error: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal menghapus data', 'error' => $e->getMessage()], 500);
        }
    }
}
