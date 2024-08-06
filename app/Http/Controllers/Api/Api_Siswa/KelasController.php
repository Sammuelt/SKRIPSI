<?php

namespace App\Http\Controllers\Api\Api_Siswa;

use App\Http\Controllers\Controller;
use App\Http\Resources\Data\Siswa\Kelas_Resource ;
use App\Models\Model_data_siswa\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class KelasController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function dataKelas()
    {
        $kelas = Kelas::all();

        //return collection of gurues as a resource
        return Kelas_Resource::collection($kelas);
    }
    /**
     * Menampilkan data inventaris berdasarkan ID
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $kelas = Kelas::find($id);

        if (!$kelas) {
            return response()->json(['message' => 'Inventaris tidak ditemukan'], 404);
        }

        Log::info('Data retrieved: ', ['id' => $id]);
        return new Kelas_Resource($kelas);
    }

     /**
     * Menambah data inventaris 
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        Log::info('Request data kelas: ', $request->all());

        $validatedData = $request->validate([
           
            'nama_kelas' => 'required|string|Max:255',
        ]);

        Log::info('Validated data: ', $validatedData);

        try {
            $kelas = Kelas::create($validatedData);
            Log::info('Data stored: ', $kelas->toArray());
            return response()->json(new Kelas_Resource($kelas), 201);
        } catch (\Exception $e) {
            Log::error('Error: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal menyimpan data', 'error' => $e->getMessage()], 500);
        }
    }
     /**
     * Mengubah data inventaris berdasarkan ID
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $kelas = Kelas::find($id);

        if (!$kelas) {
            return response()->json(['message' => 'Data Guru tidak ditemukan'], 404);
        }

        Log::info('Request data kelas: ', $request->all());

        $validatedData = $request->validate([
            'nama_kelas' => 'required|string|Max:255',
        ]);

        Log::info('Validated data: ', $validatedData);

        try {
            $kelas->update($validatedData);
            Log::info('Data updated: ', $kelas->toArray());
            return response()->json(new Kelas_Resource($kelas));
        } catch (\Exception $e) {
            Log::error('Error: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal memperbarui data', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Menghapus data inventaris berdasarkan ID
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $kelas = Kelas::find($id);

        if (!$kelas) {
            return response()->json(['message' => 'Data Guru tidak ditemukan'], 404);
        }

        try {
            $kelas->delete();
            Log::info('Data deleted: ', ['id' => $id]);
            return response()->json(['message' => 'Data Guru berhasil dihapus']);
        } catch (\Exception $e) {
            Log::error('Error: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal menghapus data', 'error' => $e->getMessage()], 500);
        }
    }
}
