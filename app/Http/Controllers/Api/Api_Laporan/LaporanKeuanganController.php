<?php

namespace App\Http\Controllers\Api\Api_Laporan;

use App\Http\Controllers\Controller;
use App\Http\Resources\Laporan\Laporan_Keuangan_Resource as Keuangan;
use App\Models\Model_laporan\Laporan_keuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LaporanKeuanganController extends Controller
{
   /**
     * index
     *
     * @return void
     */
    public function dataLaporanKeuangan()
    {
        $laporan_keuangan = Laporan_keuangan::all();

        //return collection of gurues as a resource
        return Keuangan::collection($laporan_keuangan);
    }

     /**
     * Menampilkan data Laporan Keuangan berdasarkan ID
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $laporan_keuangan = Laporan_keuangan::find($id);

        if (!$laporan_keuangan) {
            return response()->json(['message' => 'Inventaris tidak ditemukan'], 404);
        }

        Log::info('Data retrieved: ', ['id' => $id]);
        return new Keuangan($laporan_keuangan);
    }

     /**
     * Menambah data Laporan Keuangan
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        Log::info('Request data: ', $request->all());

        $validatedData = $request->validate([
            'tanggal' => 'required|date',
            'jenis_transaksi' => 'required|in:uang_masuk,uang_keluar',
            'jumlah' => 'required|integer',
            'keterangan' => 'required|string',
        ]);

        Log::info('Validated data: ', $validatedData);

        try {
            $laporan_keuangan = Laporan_keuangan::create($validatedData);
            Log::info('Data stored: ', $laporan_keuangan->toArray());
            return response()->json(new Keuangan($laporan_keuangan), 201);
        } catch (\Exception $e) {
            Log::error('Error: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal menyimpan data', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Mengubah data Laporan Keuangan berdasarkan ID
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $laporan_keuangan = Laporan_keuangan::find($id);

        if (!$laporan_keuangan) {
            return response()->json(['message' => 'Inventaris tidak ditemukan'], 404);
        }

        Log::info('Request data: ', $request->all());

        $validatedData = $request->validate([
            'tanggal' => 'required|date',
            'jenis_transaksi' => 'required|in:uang_masuk,uang_keluar',
            'jumlah' => 'required|integer',
            'keterangan' => 'required|string'
        ]);

        Log::info('Validated data: ', $validatedData);

        try {
            $laporan_keuangan->update($validatedData);
            Log::info('Data updated: ', $laporan_keuangan->toArray());
            return response()->json(new Keuangan($laporan_keuangan));
        } catch (\Exception $e) {
            Log::error('Error: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal memperbarui data', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Menghapus data Laporan Keuangan berdasarkan ID
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $laporan_keuangan = Laporan_keuangan::find($id);

        if (!$laporan_keuangan) {
            return response()->json(['message' => 'Inventaris tidak ditemukan'], 404);
        }

        try {
            $laporan_keuangan->delete();
            Log::info('Data deleted: ', ['id' => $id]);
            return response()->json(['message' => 'Inventaris berhasil dihapus']);
        } catch (\Exception $e) {
            Log::error('Error: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal menghapus data', 'error' => $e->getMessage()], 500);
        }
    }

}
