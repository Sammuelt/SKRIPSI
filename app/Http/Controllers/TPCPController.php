<?php

namespace App\Http\Controllers;

use App\Models\Model_data_siswa\Kelas;
use App\Models\Model_data_siswa\Mata_pelajaran;
use App\Models\Model_data_siswa\semester;
use App\Models\TPCP;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class TPCPController extends Controller
{
    // public function index()
    // {
    //     $Mapel = Mata_pelajaran::all();
    //     $tpcps = TPCP::all();

    //     $clases = Kelas::all();
    //     $semesters = Semester::all();

    //     Log::info('Request data to store siswa:', $tpcps->toArray());
    //     return view('pages.user.tpcp', 
    //          compact('clases', 'Mapel', 'semesters','tpcps'));
    // }

    public function add($id)
    {

        $mapel = Mata_pelajaran::findOrFail($id);

        $semester = semester::all();

        $kelas = Kelas::all();


        return view('pages.user.add-tpcp', compact('mapel', 'kelas', 'semester'));
    }

    public function FilterTpcp(Request $request)
    {
        // Ambil parameter dari request
        $idKelas = $request->input('id_kelas');
        $idSemester = $request->input('id_semester');

        // Ambil data untuk dropdown
        $clases = Kelas::all();
        $semesters = Semester::all();

        // Ambil semua data TPCP
        $tpcps = TPCP::with(['mapel'])->get();

        $mapel = Mata_pelajaran::all();

        // Filter data berdasarkan parameter yang diberikan
        $query = TPCP::query();

        if ($idKelas) {
            $query->where('id_kelas', $idKelas);
        }

        if ($idSemester) {
            $query->where('id_semester', $idSemester);
        }

        // Ambil data CP yang sesuai dengan filter
        $filteredCpData = $query->get();

        return view('pages.user.tpcp', compact('tpcps', 'mapel', 'filteredCpData', 'clases', 'semesters', 'idKelas', 'idSemester'));
    }

    public function store(Request $request)
    {
        try {
            // Validasi data request
            $validated = $request->validate([
                'id_kelas' => 'required|integer',
                'id_mapel' => 'required|integer',
                'id_semester' => 'required|integer',
                'CP' => 'required|string|max:255',
                'lingkup_materi' => 'required|string|max:255',
            ]);

            // Log request data
            Log::info('Request data to store tpcp:', $validated);

            // Cek apakah kombinasi data sudah ada di database
            $exists = TPCP::where([
                ['id_kelas', $validated['id_kelas']],
                ['id_mapel', $validated['id_mapel']],
                ['id_semester', $validated['id_semester']],
            ])->exists();

            if ($exists) {
                Log::warning('Data sudah ada di database. Tidak bisa menambahkan data baru.');
                return back()->with('error', 'Data sudah ada. Tidak bisa menambahkan data baru.');
            }

            // Buat data baru
            $tpcp = TPCP::create($validated);

            // Log success message
            Log::info('Data tpcp berhasil ditambahkan:', $tpcp->toArray());

            return redirect(route('show.tpcp.byFilter'))->with('success', 'Data berhasil ditambahkan!');
        } catch (ValidationException $e) {
            Log::error('Terjadi kesalahan validasi saat menambahkan data tpcp. Error: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Gagal menambahkan data tpcp: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Gagal menambahkan data. Silakan coba lagi.');
        }
    }

    // public function EditTpcp($id)
    // {

    //     $tpcp = TPCP::findOrFail($id);
    //     $mapel = Mata_pelajaran::findOrFail($id);
    //     $semester = semester::findOrFail($id);

    //     $kelas = Kelas::findOrFail($id);

    //     return view('pages.user.edit-tpcp', compact('tpcp', 'mapel', 'kelas', 'semester'));
    // }

    public function UpdateTpcp(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'capaian_proses' => 'required|string|max:200',
            'lingkup_materi' => 'required|string|max:200',
        ]);

        // Temukan model TPCP berdasarkan ID
        $tpcp = TPCP::findOrFail($id);

        // Perbarui data
        $tpcp->CP = $request->input('capaian_proses');
        $tpcp->lingkup_materi = $request->input('lingkup_materi');

        // Simpan perubahan ke database
        $tpcp->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Data TP/CP berhasil diperbarui.');
    }
}
