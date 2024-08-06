<?php

namespace App\Http\Controllers;

use App\Models\Model_laporan\Inventaris_barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AsetController extends Controller
{
    public function index()
    {
        $inventaris = Inventaris_barang::all();
        return view('pages.admin.inventaris', [
            'inventaris' => $inventaris,
        ]);
    }

    public function create()
    {
        return view('pages.admin.add-aset');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tgl_pembelian' => 'required|date',
            'dana_pembelian' => 'required|string|max:255',
            'kode_barang' => 'required|string|max:5',
            'nama_barang' => 'required|string|max:255',
            'jumlah' => 'required|integer|max:11',
            'kondisi' => 'required|string|in:' . implode(',', Inventaris_barang::$enumKondisi),
            'lokasi' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
            
        ]);
        Log::info('Validated data: ', $request->all());

        $aset = Inventaris_barang::create([
            'tgl_pembelian' => $validated['tgl_pembelian'],
            'dana_pembelian' => $validated['dana_pembelian'],
            'kode_barang' => $validated['kode_barang'],
            'nama_barang' => $validated['nama_barang'],
            'jumlah' => $validated['jumlah'],
            'kondisi' => $validated['kondisi'],
            'lokasi' => $validated['lokasi'],
            'keterangan' => $validated['keterangan'],
           
        ]);

        Log::info('Aset created:', $aset->toArray());

        return redirect(route('index.inventaris'))->with('success', 'Aset berhasil ditambahkan!!');
    }

    public function show_aset( )
    {
        return view("pages.admin.edit-aset");
    }
    public function edit($id){
    $aset = Inventaris_barang::findOrFail($id);
    return view('pages.admin.edit-aset', compact('aset'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'tgl_pembelian' => 'required|date',
            'dana_pembelian' => 'required|string|max:255',
            'kode_barang' => 'required|string|max:5',
            'nama_barang' => 'required|string|max:255',
            'jumlah' => 'required|integer|max:11',
            'kondisi' => 'required|string|in:' . implode(',', Inventaris_barang::$enumKondisi),
            'lokasi' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
        ]);
    
        // Log data yang tervalidasi
        Log::info('Validated data:', $validated);
    
        $aset = Inventaris_barang::findOrFail($id);
        $originalData = $aset->getOriginal(); // Data sebelum diupdate
    
        $aset->update($validated);
    
        $changedData = $aset->getChanges(); // Data yang diubah
    
        // Log perubahan data
        Log::info('Aset updated', [
            'original' => $originalData,
            'changed' => $changedData,
            'updated_by' => auth()->user()->id,
        ]);
    
        return redirect()->route('index.inventaris')->with('success', 'Item updated successfully.');
    }
    

    public function destroy($id)
    {
        $aset = Inventaris_barang::findOrFail($id);
        $aset->delete();

        return redirect(route('index.inventaris'))->with('success', 'Aset berhasil dihapus!!');
    }
}
