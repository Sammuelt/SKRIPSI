<?php

namespace App\Http\Controllers\Api\Api_Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Import Log facade
use App\Models\Model_data_siswa\tahun_ajaran;
use App\Http\Resources\Data\Siswa\TahunajaranResource;

class Tahun_ajar extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $tahunAjarans = tahun_ajaran::all();
            Log::info('Mengambil data tahun ajaran.', ['total' => $tahunAjarans->count()]);
            return TahunajaranResource::collection($tahunAjarans);
        } catch (\Exception $e) {
            Log::error('Gagal mengambil data tahun ajaran.', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Terjadi kesalahan saat mengambil data tahun ajaran.'], 500);
        }
    }
 /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $tahunAjaran = tahun_ajaran::findOrFail($id);
            Log::info('Mengambil detail tahun ajaran.', ['tahun_ajaran' => $tahunAjaran->tahun_ajaran]);
            return new TahunajaranResource($tahunAjaran);
        } catch (\Exception $e) {
            Log::error('Gagal mengambil detail tahun ajaran.', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Tidak dapat menemukan tahun ajaran yang dimaksud.'], 404);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'tahun_ajaran' => 'required|string|max:255|unique:tahun_ajarans,tahun_ajaran',
            ]);

            $tahunAjaran = tahun_ajaran::create([
                'tahun_ajaran' => $request->tahun_ajaran,
            ]);

            Log::info('Menambahkan tahun ajaran baru.', ['tahun_ajaran' => $tahunAjaran->tahun_ajaran]);
            return new TahunajaranResource($tahunAjaran);
        } catch (\Exception $e) {
            Log::error('Gagal menambahkan tahun ajaran baru.', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Terjadi kesalahan saat menambahkan tahun ajaran baru.'], 500);
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
            $tahunAjaran = tahun_ajaran::findOrFail($id);
            $tahunAjaran->delete();

            Log::info('Menghapus tahun ajaran.', ['tahun_ajaran' => $tahunAjaran->tahun_ajaran]);
            return response()->json(['message' => 'Tahun ajaran deleted successfully']);
        } catch (\Exception $e) {
            Log::error('Gagal menghapus tahun ajaran.', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Terjadi kesalahan saat menghapus tahun ajaran.'], 500);
        }
    }
}
