<?php

namespace App\Http\Controllers\Api\Api_Siswa;

use App\Http\Controllers\Controller;
use App\Http\Resources\Data\Siswa\jadwal_Mapel_Resource as Jadwal;
use App\Models\Model_data_siswa\Jadwal_pelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class JadwalMapelController extends Controller
{
   /**
     * index
     *
     * @return void
     */
    public function dataJadwalPelajaran()
    {
        $jadwal = Jadwal_pelajaran::with(['mapel', 'kelas', 'guru'])->get();

        //return collection of gurues as a resource
        return Jadwal::collection($jadwal);
    }

    
     /**
     * Menampilkan data raport siswa berdasarkan ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $jadwal = Jadwal_pelajaran::with(['mapel', 'kelas', 'guru'])->find($id);

        if (!$jadwal) {
            return response()->json(['message' => 'Data raport tidak ditemukan'], 404);
        }

        Log::info('Data retrieved: ', ['id' => $id]);
        return new Jadwal($jadwal);
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
            'id_mapel' => 'required|integer|exists:mata_pelajarans,id',
            'id_kelas' => 'required|integer|exists:kelas,id',
            'id_guru' => 'required|integer|exists:tbl_guru,id',
            'hari' => 'required|in:senin,selasa,rabu,kamis,jumat,sabtu',
            'jam_mulai' => 'required|date_format:H:i:s',
            'jam_selesai' => 'required|date_format:H:i:s',
        ]);
    
        Log::info('Validated data: ', $validatedData);
    
        try {
            $jadwal = Jadwal_pelajaran::create($validatedData);
            Log::info('Data stored: ', $jadwal->toArray());
            return response()->json(new Jadwal($jadwal), 201);
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
    $jadwal = Jadwal_pelajaran::find($id);

    if (!$jadwal) {
        return response()->json(['message' => 'Data raport tidak ditemukan'], 404);
    }

    Log::info('Request data: ', $request->all());

    $validatedData = $request->validate([
        'id_mapel' => 'required|integer|exists:mata_pelajarans,id',
        'id_kelas' => 'required|integer|exists:kelas,id',
        'id_guru' => 'required|integer|exists:tbl_guru,id',
        'hari' => 'required|in:senin,selasa,rabu,kamis,jumat,sabtu',
        'jam_mulai' => 'required|date_format:H:i:s',
        'jam_selesai' => 'required|date_format:H:i:s',
    ]);

    Log::info('Validated data: ', $validatedData);

    try {
        $jadwal->update($validatedData);
        Log::info('Data updated: ', $jadwal->toArray());
        return response()->json(new Jadwal($jadwal));
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
        $jadwal = Jadwal_pelajaran::find($id);

        if (!$jadwal) {
            return response()->json(['message' => 'Data raport tidak ditemukan'], 404);
        }

        try {
            $jadwal->delete();
            Log::info('Data deleted: ', ['id' => $id]);
            return response()->json(['message' => 'Data raport berhasil dihapus']);
        } catch (\Exception $e) {
            Log::error('Error: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal menghapus data', 'error' => $e->getMessage()], 500);
        }
    }
}
