<?php

namespace App\Http\Controllers;

use App\Models\Model_data_siswa\Mata_pelajaran;
use App\Models\Model_raport\Raport_siswa;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MapelController extends Controller
{
    public function index()
    {
        $mapel = Mata_pelajaran::all();
        return view('pages.admin.mapel', [
            'mapel' => $mapel,
        ]);
    }

    public function create()
    {
        return view('pages.admin.add-mapel');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelajaran' => 'required|string|max:255',
        ], [
            'nama_pelajaran.required' => 'Nama mata pelajaran harus diisi.',
            'nama_pelajaran.string' => 'Nama mata pelajaran harus berupa teks.',
            'nama_pelajaran.max' => 'Nama mata pelajaran tidak boleh melebihi 255 karakter.',
        ]);

        // Log validated data
        Log::info('Validated data for storing mata pelajaran:', $request->all());

        try {
            $mapel = Mata_pelajaran::create([
                'nama_pelajaran' => $request->input('nama_pelajaran'),
            ]);

            // Log success message
            Log::info('Mata pelajaran berhasil ditambahkan:', $mapel->toArray());

            return redirect(route('index.mapel'))->with('success', 'Data mata pelajaran berhasil ditambahkan!');
        } catch (\Exception $e) {
            // Log error message
            Log::error('Gagal menambahkan data mata pelajaran: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan data mata pelajaran. Silakan coba lagi.');
        }
    }

    public function show(Mata_pelajaran $mapel)
    {
        return view("pages.admin.edit-mapel", ['mapel' => $mapel]);
    }

    public function edit($id){
        $item = Mata_pelajaran::findOrFail($id);
        return view('pages.admin.edit-mapel', compact('item'));
        }

    public function update(Request $request, $id)
        {
            $validated = $request->validate([
               
                'nama_pelajaran' => 'required|string|max:255',
                
            ]);
        
            // Log data yang tervalidasi
            Log::info('Validated data:', $validated);
        
            $item = Mata_pelajaran::findOrFail($id);
            $originalData = $item->getOriginal(); // Data sebelum diupdate
        
            $item->update($validated);
        
            $changedData = $item->getChanges(); // Data yang diubah
        
            // Log perubahan data
            Log::info('Aset updated', [
                'original' => $originalData,
                'changed' => $changedData,
         
            ]);
        
            return redirect()->route('index.mapel')->with('success', 'Item updated successfully.');
    }
        
    public function delete($id)
    {
        try {
            // Temukan guru berdasarkan ID, jika tidak ada, akan memunculkan error 404
            $mapel = Mata_pelajaran::findOrFail($id);
    
            // Log ID guru yang akan dihapus
            Log::info('Menghapus Mapel dengan ID: ' . $id);
    
            // Cek apakah guru ini merupakan wali kelas
            $raport = Raport_siswa::where('id_mapel', $mapel->id)->get();
    
            if ($raport->isNotEmpty()) {
                foreach ($raport as $rpt) {
                    Log::info('Menghapus relasi kelas dengan ID mapel: ' . $rpt->id . ' yang memiliki id_mapel: ' . $mapel->id);
                   
                    $rpt->id_mapel = null;
                    $rpt->save();
                }
            }
    
           
            $mapel->delete();
            
             
             Log::info('Berhasil menghapus mapel dengan ID: ' . $id);
    
            return redirect(route('index.mapel'))->with('success', 'mapel berhasil dihapus!');
        } catch (\Exception $e) {
            // Log error
            Log::error('Error menghapus mapel dengan ID: ' . $id . '. Pesan error: ' . $e->getMessage());
    
            return redirect(route('index.mapel'))->with('error', 'Terjadi kesalahan saat menghapus guru. Silakan coba lagi.');
        }   
    }
    }

