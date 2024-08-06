<?php

namespace App\Http\Controllers\Api\Api_Siswa;

use App\Http\Controllers\Controller;
use App\Http\Resources\Data\Siswa\Mapel_Resource as Mapel;
use App\Models\Model_data_siswa\Mata_pelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MapelController extends Controller
{
   /**
     * index
     *
     * @return void
     */
    public function dataMapel()
    {
        $mata_pelajarans = Mata_pelajaran::all();

        //return collection of gurues as a resource
        return Mapel::collection($mata_pelajarans);
    }

       /**
     * Menampilkan data inventaris berdasarkan ID
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $mata_pelajarans = Mata_pelajaran::find($id);

        if (!$mata_pelajarans) {
            return response()->json(['message' => 'Inventaris tidak ditemukan'], 404);
        }

        Log::info('Data retrieved: ', ['id' => $id]);
        return new Mapel($mata_pelajarans);
    }

     /**
     * Menambah data inventaris 
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        Log::info('Request data: ', $request->all());

        $validatedData = $request->validate([
           
            'nama_pelajaran' => 'required|string|Max:255',
        ]);

        Log::info('Validated data: ', $validatedData);

        try {
            $mata_pelajarans = Mata_pelajaran::create($validatedData);
            Log::info('Data stored: ', $mata_pelajarans->toArray());
            return response()->json(new Mapel($mata_pelajarans), 201);
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
        $mata_pelajarans = Mata_pelajaran::find($id);

        if (!$mata_pelajarans) {
            return response()->json(['message' => 'Data Guru tidak ditemukan'], 404);
        }

        Log::info('Request data: ', $request->all());

        $validatedData = $request->validate([
            'nama_pelajaran' => 'required|string|Max:255',
        ]);

        Log::info('Validated data: ', $validatedData);

        try {
            $mata_pelajarans->update($validatedData);
            Log::info('Data updated: ', $mata_pelajarans->toArray());
            return response()->json(new Mapel($mata_pelajarans));
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
        $mata_pelajarans = Mata_pelajaran::find($id);

        if (!$mata_pelajarans) {
            return response()->json(['message' => 'Data Guru tidak ditemukan'], 404);
        }

        try {
            $mata_pelajarans->delete();
            Log::info('Data deleted: ', ['id' => $id]);
            return response()->json(['message' => 'Data Guru berhasil dihapus']);
        } catch (\Exception $e) {
            Log::error('Error: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal menghapus data', 'error' => $e->getMessage()], 500);
        }
    }
}
