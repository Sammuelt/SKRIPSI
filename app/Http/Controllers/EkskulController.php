<?php

namespace App\Http\Controllers;

use App\Models\Model_data_siswa\Extrakulikuler;
use App\Models\Model_raport\raport_ekstrakulikuler_siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EkskulController extends Controller
{
    public function index() {
        $ekskul = Extrakulikuler::all();
        return view('pages.admin.ekskul',[
            'ekskul' => $ekskul,
        ]);
    }
    public function create()
    {
        return view('pages.admin.add-ekskul');
    }
    public function store(Request $request)
    {
        $request->validate([
            'ekstrakulikuler' => 'required|string|max:255',
        ]);

        // Log validated data
        Log::info('Validated data for storing mata pelajaran:', $request->all());

        try {
            $ekskul = Extrakulikuler::create([
                'ekstrakulikuler' => $request->input('ekstrakulikuler'),
            ]);

            // Log success message
            Log::info('Mata pelajaran berhasil ditambahkan:', $ekskul->toArray());

            return redirect(route('index.ekskul'))->with('success', 'Data mata pelajaran berhasil ditambahkan!');
        } catch (\Exception $e) {
            // Log error message
            Log::error('Gagal menambahkan data mata pelajaran: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan data mata pelajaran. Silakan coba lagi.');
        }
    }

    public function show(Extrakulikuler $ekskul)
    {
        return view("pages.admin.edit-ekskul", ['ekskul' => $ekskul]);
    }

        
    public function delete($id)
    {
        try {
            // Temukan guru berdasarkan ID, jika tidak ada, akan memunculkan error 404
            $ekskul = Extrakulikuler::findOrFail($id);
    
            // Log ID guru yang akan dihapus
            Log::info('Menghapus Ekskul dengan ID: ' . $id);
    
            // Cek apakah guru ini merupakan wali kelas
            $raport = raport_ekstrakulikuler_siswa::where('id_ekstrakulikuler', $ekskul->id)->get();
    
            if ($raport->isNotEmpty()) {
                foreach ($raport as $rpt) {
                    Log::info('Menghapus relasi kelas dengan ID Ekskul: ' . $rpt->id . ' yang memiliki id_ekskul: ' . $ekskul->id);
                   
                    $rpt->id_mapel = null;
                    $rpt->save();
                }
            }
    
           
            $ekskul->delete();
            
             
             Log::info('Berhasil menghapus mapel dengan ID: ' . $id);
    
            return redirect(route('index.ekskul'))->with('success', 'mapel berhasil dihapus!');
        } catch (\Exception $e) {
            // Log error
            Log::error('Error menghapus mapel dengan ID: ' . $id . '. Pesan error: ' . $e->getMessage());
    
            return redirect(route('index.ekskul'))->with('error', 'Terjadi kesalahan saat menghapus guru. Silakan coba lagi.');
        }   
    }
}
