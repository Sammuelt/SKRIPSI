<?php

namespace App\Http\Controllers\Api\Api_Siswa;

use App\Http\Controllers\Controller;
use App\Http\Resources\Data\Siswa\Siswa_Resource as DataSiswaResource;
use App\Models\Model_data_siswa\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DataSiswaController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function dataSiswa()
    {
        $data_siswa = Siswa::all();

        //return collection of gurues as a resource
        return DataSiswaResource::collection($data_siswa);
    }

      /**
     * Menampilkan data inventaris berdasarkan ID
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $data_siswa = Siswa::find($id);

        if (!$data_siswa) {
            return response()->json(['message' => 'data siswa tidak ditemukan'], 404);
        }

        Log::info('Data retrieved: ', ['id' => $id]);
        return new DataSiswaResource($data_siswa);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Log::info('Request data: ', $request->all());

        $validatedData = $request->validate([
            'nisn' => 'required|numeric|unique:tbl_data_siswa,nisn',
            'id_kelas' => 'required|integer|exists:kelas,id',
            'nama_lengkap' => 'required|string|Max:255',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'tempat_lahir' => 'required|string|Max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|Max:255',
            'nama_orang_tua' => 'required|string|Max:255',
            'no_hp_ortu' => 'required|string|max:13',
        ]);

        Log::info('Validated data: ', $validatedData);

        try {
            $tbl_guru = Siswa::create($validatedData);
            Log::info('Data stored: ', $tbl_guru->toArray());
            return response()->json(new DataSiswaResource($tbl_guru), 201);
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
        $tbl_guru = Siswa::find($id);

        if (!$tbl_guru) {
            return response()->json(['message' => 'Data Guru tidak ditemukan'], 404);
        }

        Log::info('Request data: ', $request->all());

        $validatedData = $request->validate([
            'nisn' => 'required|numeric|unique:tbl_data_siswa,nisn',
            'id_kelas' => 'required|integer|exists:kelas,id',
            'nama_lengkap' => 'required|string|Max:255',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'tempat_lahir' => 'required|string|Max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|Max:255',
            'nama_orang_tua' => 'required|string|Max:255',
            'no_hp_ortu' => 'required|string|max:13',
        ]);

        Log::info('Validated data: ', $validatedData);

        try {
            $tbl_guru->update($validatedData);
            Log::info('Data updated: ', $tbl_guru->toArray());
            return response()->json(new DataSiswaResource($tbl_guru));
        } catch (\Exception $e) {
            Log::error('Error: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal memperbarui data', 'error' => $e->getMessage()], 500);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data_siswa = Siswa::findOrFail($id);
            $data_siswa->delete();

            Log::info('Menghapus tahun ajaran.', ['tahun_ajaran' => $data_siswa->tahun_ajaran]);
            return response()->json(['message' => 'Tahun ajaran deleted successfully']);
        } catch (\Exception $e) {
            Log::error('Gagal menghapus tahun ajaran.', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Terjadi kesalahan saat menghapus tahun ajaran.'], 500);
        }
    }
}
