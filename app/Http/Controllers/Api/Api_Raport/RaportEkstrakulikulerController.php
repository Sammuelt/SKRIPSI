<?php

namespace App\Http\Controllers\Api\Api_Raport;

use App\Http\Controllers\Controller;
use App\Http\Resources\Raport\Raport_Extrakulikuler_Resource as RaportEkstra;
use App\Models\Model_raport\raport_ekstrakulikuler_siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RaportEkstrakulikulerController extends Controller
{
   /**
     * index
     *
     * @return \Illuminate\Http\Response
     */
    public function dataRaportExtraculicular()
    {
        // Menggunakan eager loading untuk relasi
        $raport_ekstrakulikuler = raport_ekstrakulikuler_siswa::with(['siswa', 'semester', 'tahunAjaran'])->get();

        // Mengembalikan koleksi kehadiran sebagai resource
        return RaportEkstra::collection($raport_ekstrakulikuler);
        return view('pages.login',[
            "extraraport" => raport_ekstrakulikuler_siswa::with(['siswa', 'semester', 'tahunAjaran'])->get()
        ]);
    }

       /**
     * Menampilkan data raport siswa berdasarkan ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $raport_ekstra = raport_ekstrakulikuler_siswa::with(['siswa', 'kelas', 'semester', 'tahunAjaran',])->find($id);

        if (!$raport_ekstra) {
            return response()->json(['message' => 'Data raport tidak ditemukan'], 404);
        }

        Log::info('Data retrieved: ', ['id' => $id]);
        return new RaportEkstra($raport_ekstra);
    }

    /**
     * Menambah data raport siswa.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        Log::info('Request data Raport Ekstrakulikuler: ', $request->all());

        $validatedData = $request->validate([

            'id_siswa' => 'required|integer|exists:tbl_data_siswa,id',
            'id_kelas' => 'required|integer|exists:kelas,id',
            'id_semester' => 'required|integer|exists:semesters,id',
            'id_tahun_ajar' => 'required|integer|exists:tahun_ajarans,id',
            'id_ekstrakulikuler' => 'required|integer|exists:extrakulikulers,id',
            'predikat' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
            
        ]);

        Log::info('Validated data Raport Ekstrakulikuler: ', $validatedData);

        try {
            $raport_ekstra = raport_ekstrakulikuler_siswa::create($validatedData);
            Log::info('Data Terkirim ke database: ', $raport_ekstra->toArray());
            return response()->json(new RaportEkstra($raport_ekstra), 201);
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
        $raport_ekstra = raport_ekstrakulikuler_siswa::find($id);

        if (!$raport_ekstra) {
            return response()->json(['message' => 'Data raport tidak ditemukan'], 404);
        }

        Log::info('Request data: ', $request->all());

        $validatedData = $request->validate([
            'id_siswa' => 'required|integer|exists:tbl_data_siswa,id',
            'id_kelas' => 'required|integer|exists:kelas,id',
            'id_semester' => 'required|integer|exists:semesters,id',
            'id_tahun_ajar' => 'required|integer|exists:tahun_ajarans,id',
            'id_ekstrakulikuler' => 'required|integer|exists:extrakulikulers,id',
            'predikat' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
        ]);

        Log::info('Validated data Raport Ekstrakulikuler: ', $validatedData);

        try {
            $raport_ekstra->update($validatedData);
            Log::info('Data Raport Ekstrakulikuler updated: ', $raport_ekstra->toArray());
            return response()->json(new RaportEkstra($raport_ekstra));
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
        $raport_mbkm = raport_ekstrakulikuler_siswa::find($id);

        if (!$raport_mbkm) {
            return response()->json(['message' => 'Data raport tidak ditemukan'], 404);
        }

        try {
            $raport_mbkm->delete();
            Log::info('Data Raport Ekstrakulikuler deleted: ', ['id' => $id]);
            return response()->json(['message' => 'Data raport berhasil dihapus']);
        } catch (\Exception $e) {
            Log::error('Error: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal menghapus data', 'error' => $e->getMessage()], 500);
        }
    }
}
