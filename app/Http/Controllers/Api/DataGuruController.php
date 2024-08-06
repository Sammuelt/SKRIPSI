<?php
namespace App\Http\Controllers\Api;

use App\Models\Guru;
use App\Http\Controllers\Controller;
use App\Http\Resources\Data\Guru\GuruResource as GuruGuruResource;
use Illuminate\Http\Request;
use App\Http\Resources\GuruResource;
use Illuminate\Support\Facades\Log;

class DataGuruController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function dataGuru()
    {
        $tbl_guru = Guru::all();

        //return collection of gurues as a resource
        return GuruGuruResource::collection($tbl_guru);
    }

      /**
     * Menampilkan data inventaris berdasarkan ID
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $tbl_guru = Guru::find($id);

        if (!$tbl_guru) {
            return response()->json(['message' => 'Inventaris tidak ditemukan'], 404);
        }

        Log::info('Data retrieved: ', ['id' => $id]);
        return new GuruGuruResource($tbl_guru);
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
            'nomor_induk_pegawai' => 'required|numeric|unique:tbl_guru,nomor_induk_pegawai',
            'nama' => 'required|string|Max:255',
            'alamat' => 'required|string|Max:255',
            'tempat_lahir' => 'required|string|Max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'pendidikan' => 'required|string|Max:255',
            'golongan' => 'required|string|Max:255',
            'no_hp' => 'required|string|max:13',
            'email' => 'required|string|Max:255',
        ]);

        Log::info('Validated data: ', $validatedData);

        try {
            $tbl_guru = Guru::create($validatedData);
            Log::info('Data stored: ', $tbl_guru->toArray());
            return response()->json(new GuruGuruResource($tbl_guru), 201);
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
        $tbl_guru = Guru::find($id);

        if (!$tbl_guru) {
            return response()->json(['message' => 'Data Guru tidak ditemukan'], 404);
        }

        Log::info('Request data: ', $request->all());

        $validatedData = $request->validate([
            'nomor_induk_pegawai' => 'required|numeric|unique:tbl_guru,nomor_induk_pegawai',
            'nama' => 'required|string',
            'alamat' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'pendidikan' => 'required|string',
            'golongan' => 'nullable|string',
            'no_hp' => 'nullable|string|max:13',
            'email' => 'nullable|string',
        ]);

        Log::info('Validated data: ', $validatedData);

        try {
            $tbl_guru->update($validatedData);
            Log::info('Data updated: ', $tbl_guru->toArray());
            return response()->json(new GuruGuruResource($tbl_guru));
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
        $tbl_guru = Guru::find($id);

        if (!$tbl_guru) {
            return response()->json(['message' => 'Data Guru tidak ditemukan'], 404);
        }

        try {
            $tbl_guru->delete();
            Log::info('Data deleted: ', ['id' => $id]);
            return response()->json(['message' => 'Data Guru berhasil dihapus']);
        } catch (\Exception $e) {
            Log::error('Error: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal menghapus data', 'error' => $e->getMessage()], 500);
        }
    }
}
