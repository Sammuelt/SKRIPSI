<?php
namespace App\Http\Controllers\Api\Api_Laporan;

use App\Http\Controllers\Controller;
use App\Http\Resources\Laporan\Laporan_Inventaris_Resource as Inventaris;
use App\Models\Model_laporan\Inventaris_barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class InventarisController extends Controller
{
    public function dataInventaris()
    {
        $inventaris_barang = Inventaris_barang::all();
        return Inventaris::collection($inventaris_barang);
    }

    /**
     * Menampilkan data inventaris berdasarkan ID
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $inventaris_barang = Inventaris_barang::find($id);

        if (!$inventaris_barang) {
            return response()->json(['message' => 'Inventaris tidak ditemukan'], 404);
        }

        Log::info('Data retrieved: ', ['id' => $id]);
        return new Inventaris($inventaris_barang);
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
            'tgl_pembelian' => 'required|date',
            'dana_pembelian' => 'required|string|max:255',
            'kode_barang' => 'required|string|max:255',
            'nama_barang' => 'required|string|max:255',
            'jumlah' => 'required|integer',
            'kondisi' => 'required|in:sangat_bagus,bagus,cukup_bagus,tidak_bagus,rusak',
            'lokasi' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        Log::info('Validated data: ', $validatedData);

        try {
            $inventaris_barang = Inventaris_barang::create($validatedData);
            Log::info('Data stored: ', $inventaris_barang->toArray());
            return response()->json(new Inventaris($inventaris_barang), 201);
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
        $inventaris_barang = Inventaris_barang::find($id);

        if (!$inventaris_barang) {
            return response()->json(['message' => 'Inventaris tidak ditemukan'], 404);
        }

        Log::info('Request data: ', $request->all());

        $validatedData = $request->validate([
            'tgl_pembelian' => 'required|date',
            'dana_pembelian' => 'required|string|max:255',
            'kode_barang' => 'required|string|max:5',
            'nama_barang' => 'required|string|max:255',
            'jumlah' => 'required|integer',
            'kondisi' => 'required|in:sangat_bagus,bagus,cukup_bagus,tidak_bagus,rusak',
            'lokasi' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        Log::info('Validated data: ', $validatedData);

        try {
            $inventaris_barang->update($validatedData);
            Log::info('Data updated: ', $inventaris_barang->toArray());
            return response()->json(new Inventaris($inventaris_barang));
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
        $inventaris_barang = Inventaris_barang::find($id);

        if (!$inventaris_barang) {
            return response()->json(['message' => 'Inventaris tidak ditemukan'], 404);
        }

        try {
            $inventaris_barang->delete();
            Log::info('Data deleted: ', ['id' => $id]);
            return response()->json(['message' => 'Inventaris berhasil dihapus']);
        } catch (\Exception $e) {
            Log::error('Error: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal menghapus data', 'error' => $e->getMessage()], 500);
        }
    }
}
