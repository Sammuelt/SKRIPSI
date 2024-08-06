<?php

namespace App\Http\Controllers\Api\Api_Siswa;

use App\Http\Controllers\Controller;
use App\Http\Resources\Data\Siswa\Extrakulikuler_Resource as Ekstra;
use App\Models\Model_data_siswa\Extrakulikuler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EkstrakulikulerController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function dataListExtraculicular()
    {
        $ekstra = Extrakulikuler::all();

        //return collection of gurues as a resource
        return Ekstra::collection($ekstra);
    }
    
      /**
     * Menampilkan data inventaris berdasarkan ID
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $ekstra = Extrakulikuler::find($id);

        if (!$ekstra) {
            return response()->json(['message' => 'Inventaris tidak ditemukan'], 404);
        }

        Log::info('Data retrieved: ', ['id' => $id]);
        return new Ekstra($ekstra);
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
           
            'ekstrakulikuler' => 'required|string|Max:255',
        ]);

        Log::info('Validated data: ', $validatedData);

        try {
            $ekstra = Extrakulikuler::create($validatedData);
            Log::info('Data stored: ', $ekstra->toArray());
            return response()->json(new Ekstra($ekstra), 201);
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
        $ekstra = Extrakulikuler::find($id);

        if (!$ekstra) {
            return response()->json(['message' => 'Data Guru tidak ditemukan'], 404);
        }

        Log::info('Request data: ', $request->all());

        $validatedData = $request->validate([
            'ekstrakulikuler' => 'required|string|Max:255',
        ]);

        Log::info('Validated data: ', $validatedData);

        try {
            $ekstra->update($validatedData);
            Log::info('Data updated: ', $ekstra->toArray());
            return response()->json(new Ekstra($ekstra));
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
        $ekstra = Extrakulikuler::find($id);

        if (!$ekstra) {
            return response()->json(['message' => 'Data Guru tidak ditemukan'], 404);
        }

        try {
            $ekstra->delete();
            Log::info('Data deleted: ', ['id' => $id]);
            return response()->json(['message' => 'Data Guru berhasil dihapus']);
        } catch (\Exception $e) {
            Log::error('Error: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal menghapus data', 'error' => $e->getMessage()], 500);
        }
    }
}
