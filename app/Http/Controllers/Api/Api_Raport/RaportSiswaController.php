<?php

namespace App\Http\Controllers\Api\Api_Raport;

use App\Http\Controllers\Controller;
use App\Http\Resources\Raport\Raport_Siswa_Resource as RaportSiswa;
use App\Models\Model_raport\Raport_siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RaportSiswaController extends Controller
{
     /**
     * index
     *
     * @return \Illuminate\Http\Response
     */
    public function dataRaportSiswa()
    {
        // Menggunakan eager loading untuk relasi
        $raport_siswa = Raport_siswa::with(['siswa', 'semester', 'tahunAjaran', 'mapel'])->get();

        // Mengembalikan koleksi kehadiran sebagai resource
        return RaportSiswa::collection($raport_siswa);
    }

    
     /**
     * Menampilkan data raport siswa berdasarkan ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $raport_siswa = Raport_siswa::with(['siswa', 'kelas', 'semester', 'tahunAjaran', 'mapel'])->find($id);

        if (!$raport_siswa) {
            return response()->json(['message' => 'Data raport tidak ditemukan'], 404);
        }

        Log::info('Data retrieved: ', ['id' => $id]);
        return new RaportSiswa($raport_siswa);
    }
     /**
     * Menambah data raport siswa.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        Log::info('Request data Raport Siswa: ', $request->all());

        $validatedData = $request->validate([
            'id_tahun_ajar' => 'required|integer|exists:tahun_ajarans,id',
            'id_semester' => 'required|integer|exists:semesters,id',
            'id_siswa' => 'required|integer|exists:tbl_data_siswa,id',
            'id_kelas' => 'required|integer|exists:kelas,id',
            'id_mapel' => 'required|integer|exists:mata_pelajarans,id',
            'nilai' => 'required|integer',
            'kekurangan_kompetensi' => 'required|string|max:255',
            'kelebihan_kompetensi' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
        ]);

        Log::info('Validated data: ', $validatedData);

        try {
            $raport_siswa = Raport_siswa::create($validatedData);
            Log::info('Data stored: ', $raport_siswa->toArray());
            return response()->json(new RaportSiswa($raport_siswa), 201);
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
        $raport_siswa = Raport_siswa::find($id);

        if (!$raport_siswa) {
            return response()->json(['message' => 'Data raport tidak ditemukan'], 404);
        }

        Log::info('Request data: ', $request->all());

        $validatedData = $request->validate([
            'id_tahun_ajar' => 'required|integer|exists:tahun_ajarans,id',
            'id_semester' => 'required|integer|exists:semesters,id',
            'id_siswa' => 'required|integer|exists:tbl_data_siswa,id',
            'id_kelas' => 'required|integer|exists:kelas,id',
            'id_mapel' => 'required|integer|exists:mata_pelajarans,id',
            'nilai' => 'required|integer',
            'kekurangan_kompetensi' => 'required|string|max:255',
            'kelebihan_kompetensi' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
        ]);

        Log::info('Validated data: ', $validatedData);

        try {
            $raport_siswa->update($validatedData);
            Log::info('Data updated: ', $raport_siswa->toArray());
            return response()->json(new RaportSiswa($raport_siswa));
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
        $raport_siswa = Raport_siswa::find($id);

        if (!$raport_siswa) {
            return response()->json(['message' => 'Data raport tidak ditemukan'], 404);
        }

        try {
            $raport_siswa->delete();
            Log::info('Data deleted: ', ['id' => $id]);
            return response()->json(['message' => 'Data raport berhasil dihapus']);
        } catch (\Exception $e) {
            Log::error('Error: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal menghapus data', 'error' => $e->getMessage()], 500);
        }
    }
}
