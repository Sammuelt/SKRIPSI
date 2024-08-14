<?php

namespace App\Http\Controllers;

use App\Models\CapaianFase;
use App\Models\Mbkm_siswa;
use App\Models\Model_data_siswa\Extrakulikuler;
use App\Models\Model_data_siswa\Kelas;
use App\Models\Model_data_siswa\Mata_pelajaran;
use App\Models\Model_data_siswa\Semester;
use App\Models\Model_data_siswa\Siswa;
use App\Models\Model_data_siswa\tahun_ajaran;
use App\Models\Model_raport\raport_ekstrakulikuler_siswa;
use App\Models\Model_raport\Raport_Mbkm;
use App\Models\Model_raport\Raport_siswa;
use App\Models\RaportMbkmSiswa;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class NilaiController extends Controller
{
    // public function indexByAkademik()
    // {
    //     $clases = Kelas::all();
    //     $siswas = Siswa::all();
    //     $semesters = Semester::all();
    //     $tahunajarans = tahun_ajaran::all();
    //     $mapel = Mata_pelajaran::all();
    //     $nilai = Raport_siswa::all();
    //     return view('pages.user.nilai-akademik', compact('clases', 'siswas', 'semesters', 'tahunajarans', 'mapel'));
    // }

    // Di Controller
    // public function index(Request $request)
    // {
    //     $query = Mata_pelajaran::query();

    //     if ($request->filled('id_kelas')) {
    //         $query->where('id_kelas', $request->input('id_kelas'));
    //     }
    //     if ($request->filled('id_tahun_ajar')) {
    //         $query->where('id_tahun_ajar', $request->input('id_tahun_ajar'));
    //     }
    //     if ($request->filled('id_siswa')) {
    //         $query->where('id_siswa', $request->input('id_siswa'));
    //     }
    //     if ($request->filled('id_semester')) {
    //         $query->where('id_semester', $request->input('id_semester'));
    //     }

    //     $mapel = $query->get();

    //     return view('pages.user.nilai-akademik', compact('mapel'));
    // }
    // {
    //     $request->validate([
    //         'id_kelas' => 'nullable|integer|exists:kelas,id',
    //         'id_tahun_ajar' => 'nullable|integer|exists:tahun_ajaran,id',
    //         'id_semester' => 'nullable|integer|exists:semesters,id',
    //         'id_siswa' => 'nullable|integer|exists:tbl_data_siswa,id',
    //     ]);

    //     $idKelas = $request->input('id_kelas');
    //     $idTahunAjar = $request->input('id_tahun_ajar');
    //     $idSemester = $request->input('id_semester');
    //     $idSiswa = $request->input('id_siswa');

    //     $clases = Kelas::all();
    //     $tahunajarans = tahun_ajaran::all();
    //     $semesters = Semester::all();

    //     $siswas = Siswa::when($idKelas, function ($query, $idKelas) {
    //         return $query->where('id_kelas_now', $idKelas);
    //     })->when($idTahunAjar, function ($query, $idTahunAjar) {
    //         return $query->where('id_tahun_ajaran', $idTahunAjar);
    //     })->when($idSemester, function ($query, $idSemester) {
    //         return $query->where('id_semester', $idSemester);
    //     })->when($idSiswa, function ($query, $idSiswa) {
    //         return $query->where('id', $idSiswa);
    //     })->get();

    //     $mapel = Mata_pelajaran::all();

    //     return view('pages.user.nilai-akademik', compact('clases', 'tahunajarans', 'semesters', 'siswas', 'mapel'));
    // }
    public function filterSiswa(Request $request)
    {
        // Ambil parameter dari request
        $idKelas = $request->input('id_kelas');
        $idTahunAjar = $request->input('id_tahun_ajar');
        $idSiswa = $request->input('id_siswa');
        $idSemester = $request->input('id_semester');

        // Ambil data untuk dropdown
        $clases = Kelas::all();
        $tahunajarans = Tahun_ajaran::all();
        $semesters = Semester::all();

        // Filter siswa berdasarkan kelas yang dipilih
        if ($idKelas) {
            $siswas = Siswa::where('id_kelas_now', $idKelas)->get();
        } else {
            $siswas = Siswa::all();
        }

        // Filter data nilai rapor berdasarkan parameter yang diberikan
        $query = Raport_siswa::query();

        if ($idKelas) {
            $query->where('id_kelas', $idKelas);
        }

        if ($idTahunAjar) {
            $query->where('id_tahun_ajar', $idTahunAjar);
        }

        if ($idSiswa) {
            $query->where('id_siswa', $idSiswa);
        }

        if ($idSemester) {
            $query->where('id_semester', $idSemester);
        }

        $nilai = $query->get();

        // Ambil daftar mata pelajaran
        $mapel = Mata_pelajaran::all();

        return view('pages.user.nilai-akademik', compact('nilai', 'clases', 'tahunajarans', 'siswas', 'semesters', 'mapel'));
    }

    // public function store(Request $request)
    // {
    //     Log::info('Request data received:', $request->all());

    //     $validated = $request->validate([
    //         'id_tahun_ajar' => 'required|integer|exists:tahun_ajarans,id',
    //         'id_semester' => 'required|integer|exists:semesters,id',
    //         'id_siswa' => 'required|integer|exists:tbl_data_siswa,id',
    //         'id_kelas' => 'nullable|integer|exists:kelas,id',
    //         'id_mapel' => 'required|integer|exists:mata_pelajarans,id',
    //         'nilai' => 'required|integer|min:0|max:100',
    //         'kekurangan_kompetensi' => 'required|string|max:255',
    //         'kelebihan_kompetensi' => 'required|string|max:255',
    //         'keterangan' => 'nullable|string',
    //     ]);

    //     try {
    //         // Log request data
    //         Log::info('Request data to store nilai:', $validated);

    //         // Buat data nilai baru
    //         $nilai = Raport_siswa::create($validated);

    //         // Log success message
    //         Log::info('Data nilai Raport berhasil ditambahkan:', $nilai->toArray());

    //         return redirect()->route('index.input.akademik')->with('success', 'Data nilai berhasil ditambahkan!');
    //     } catch (ValidationException $e) {
    //         Log::error('Terjadi kesalahan validasi saat menambahkan data nilai. Error: ' . json_encode($e->errors()));
    //         return back()->withErrors($e->errors())->withInput();
    //     } catch (\Exception $e) {
    //         Log::error('Gagal menambahkan data nilai: ' . $e->getMessage());
    //         return back()->withInput()->with('error', 'Gagal menambahkan data nilai. Silakan coba lagi.');
    //     }
    // }
    public function store(Request $request)
    {
        // Validasi data yang diterima dari formulir
        $request->validate([
            'id_mapel' => 'required|exists:mata_pelajarans,id',
            'id_tahun_ajar' => 'required|exists:tahun_ajarans,id',
            'id_semester' => 'required|exists:semesters,id',
            'id_siswa' => 'required|exists:tbl_data_siswa,id',
            'id_kelas' => 'required|exists:kelas,id',
            'nilai' => 'required|numeric|min:0|max:100',
            'kelebihan_kompetensi' => 'required|string|max:255',
            'kekurangan_kompetensi' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        // Simpan data nilai ke dalam database
        Raport_siswa::create([
            'id_mapel' => $request->id_mapel,
            'id_tahun_ajar' => $request->id_tahun_ajar,
            'id_semester' => $request->id_semester,
            'id_siswa' => $request->id_siswa,
            'id_kelas' => $request->id_kelas,
            'nilai' => $request->nilai,
            'kelebihan_kompetensi' => $request->kelebihan_kompetensi,
            'kekurangan_kompetensi' => $request->kekurangan_kompetensi,
        ]);

        // Redirect atau return response sesuai kebutuhan Anda
        return redirect()->back()->with('success', 'Nilai berhasil ditambahkan.');
    }

    public function EditNilaiAkademik(Request $request)
    { {
            try {
                // Log the incoming request data
                Log::info('Request data :', $request->all());

                // Validasi data yang diterima dari formulir
                $request->validate([
                    'id_mapel' => 'required|exists:mata_pelajarans,id',
                    'id_tahun_ajar' => 'required|exists:tahun_ajarans,id',
                    'id_semester' => 'required|exists:semesters,id',
                    'id_siswa' => 'required|exists:tbl_data_siswa,id',
                    'id_kelas' => 'required|exists:kelas,id',
                    'nilai' => 'required|numeric|min:0|max:100',
                    'kelebihan_kompetensi' => 'required|string|max:255',
                    'kekurangan_kompetensi' => 'required|string|max:255',
                    'keterangan' => 'nullable|string',
                ]);



                // Cari data berdasarkan id_project dan id_siswa untuk melakukan update
                $raportsiswa = Raport_siswa::where('id', $request->id)
                    ->first();

                // Jika data ditemukan, lakukan update
                $raportsiswa->update([
                    'id_tahun_ajar' => $request->id_tahun_ajar,
                    'id_semester' => $request->id_semester,
                    'id_kelas' => $request->id_kelas,
                    'id_siswa' => $request->id_siswa,
                    'id_mapel' => $request->id_mapel,
                    'nilai' => $request->nilai,
                    'kelebihan_kompetensi' => $request->kelebihan_kompetensi,
                    'kekurangan_kompetensi' => $request->kekurangan_kompetensi
                ]);


                return redirect()->back()->with('success', 'Nilai berhasil diperbarui');
            } catch (Exception $e) {
                // Log the exception details
                Log::error('Failed to store Judul Raport MBKM', [
                    'error' => $e->getMessage(),
                    'request' => $request->all()
                ]);

                // Redirect back with an error message
                return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan nilai. Silakan coba lagi.');
            }
        }
    }


    public function FilterAll(Request $request)
    {
        // Ambil parameter dari request
        $idKelas = $request->input('id_kelas');
        $idTahunAjar = $request->input('id_tahun_ajar');
        $idSiswa = $request->input('id_siswa');
        $idSemester = $request->input('id_semester');

        // Ambil data untuk dropdown
        $clases = Kelas::all();
        $tahunajarans = tahun_ajaran::all();
        $semesters = Semester::all();

        // Filter siswa berdasarkan kelas yang dipilih
        if ($idKelas) {
            $siswas = Siswa::where('id_kelas_now', $idKelas)->get();
        } else {
            $siswas = Siswa::all();
        }

        // Filter data berdasarkan parameter yang diberikan
        $query = raport_ekstrakulikuler_siswa::query();

        if ($idKelas) {
            $query->where('id_kelas', $idKelas);
        }

        if ($idTahunAjar) {
            $query->where('id_tahun_ajar', $idTahunAjar);
        }

        if ($idSiswa) {
            $query->where('id_siswa', $idSiswa);
        }

        if ($idSemester) {
            $query->where('id_semester', $idSemester);
        }


        $ekskul = $query->get();

        $ekskuls = Extrakulikuler::all();

        return view('pages.user.nilai-ekskul', compact('ekskuls', 'ekskul', 'clases', 'tahunajarans', 'siswas', 'semesters'));
    }



    public function StoreEkskul(Request $request)
    {
        Log::info('Request data received:', $request->all());

        $validated = $request->validate([
            'id_tahun_ajar' => 'required|integer|exists:tahun_ajarans,id',
            'id_semester' => 'required|integer|exists:semesters,id',
            'id_siswa' => 'required|integer|exists:tbl_data_siswa,id',
            'id_kelas' => 'nullable|integer|exists:kelas,id',
            'id_ekstrakulikuler' => 'required|integer|exists:extrakulikulers,id',
            'predikat' => 'required|string|min:0',
            'keterangan' => 'nullable|string',
        ]);

        try {
            // Log request data
            Log::info('Request data to store ekskul:', $validated);

            // Cek apakah data dengan kombinasi yang sama sudah ada
            $existingRecord = raport_ekstrakulikuler_siswa::where([
                'id_tahun_ajar' => $validated['id_tahun_ajar'],
                'id_semester' => $validated['id_semester'],
                'id_siswa' => $validated['id_siswa'],
                'id_kelas' => $validated['id_kelas'],
                'id_ekstrakulikuler' => $validated['id_ekstrakulikuler']
            ])->first();

            if ($existingRecord) {
                // Jika data sudah ada, kembalikan pesan kesalahan
                Log::warning('Data nilai sudah ada:', $validated);
                return back()->with('error', 'Data nilai sudah ada!')->withInput();
            }

            // Buat data nilai baru jika data belum ada
            $nilai = raport_ekstrakulikuler_siswa::create($validated);

            // Log success message
            Log::info('Data nilai Raport berhasil ditambahkan:', $nilai->toArray());

            return redirect()->route('show.ekskul.byFilter', [
                'id_kelas' => $validated['id_kelas'],
                'id_tahun_ajar' => $validated['id_tahun_ajar'],
                'id_siswa' => $validated['id_siswa'],
                'id_semester' => $validated['id_semester']
            ])->with('success', 'Data nilai berhasil ditambahkan!');
        } catch (ValidationException $e) {
            Log::error('Terjadi kesalahan validasi saat menambahkan data nilai. Error: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Gagal menambahkan data nilai: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Gagal menambahkan data nilai. Silakan coba lagi.');
        }
    }





    public function UpdateEkskul(Request $request)
    {

        Log::info('Request data received:', $request->all());


        $validated = $request->validate([
            'id_tahun_ajar' => 'required|integer|exists:tahun_ajarans,id',
            'id_semester' => 'required|integer|exists:semesters,id',
            'id_siswa' => 'required|integer|exists:tbl_data_siswa,id',
            'id_kelas' => 'nullable|integer|exists:kelas,id',
            'id_ekstrakulikuler' => 'required|integer|exists:extrakulikulers,id',
            'predikat' => 'required|string|min:0',
            'keterangan' => 'nullable|string',
        ]);

        try {

            $nilai = raport_ekstrakulikuler_siswa::findOrFail($request->id);


            $nilai->update($validated);


            Log::info('Data nilai Raport berhasil diperbarui:', $nilai->toArray());


            return redirect()->route('show.ekskul.byFilter', [
                'id_kelas' => $validated['id_kelas'],
                'id_tahun_ajar' => $validated['id_tahun_ajar'],
                'id_siswa' => $validated['id_siswa'],
                'id_semester' => $validated['id_semester']
            ])->with('success', 'Data nilai berhasil ditambahkan!');
        } catch (ValidationException $e) {

            Log::error('Terjadi kesalahan validasi saat memperbarui data nilai. Error: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {

            Log::error('Gagal memperbarui data nilai: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Gagal memperbarui data nilai. Silakan coba lagi.');
        }
    }

    public function destroy($id)
    {
        try {
            $item = raport_ekstrakulikuler_siswa::findOrFail($id);


            $item->delete();


            Log::info("Item dengan ID {$id} berhasil dihapus.");


            return response()->json(['success' => true]);
        } catch (\Exception $e) {

            Log::error("Gagal menghapus item dengan ID {$id}. Pesan kesalahan: " . $e->getMessage());


            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan saat menghapus item.'], 500);
        }
    }

    //MBKM INPUT NILAI PROJECT
    public function FilterProject(Request $request)
    {
        // Ambil parameter dari request
        $idKelas = $request->input('id_kelas');
        $idTahunAjar = $request->input('id_tahun_ajar');
        $idSiswa = $request->input('id_siswa');
        $idSemester = $request->input('id_semester');
        $idProject = $request->input('id_project');

        // Log parameter request
        Log::info('FilterProject called with parameters:', [
            'id_kelas' => $idKelas,
            'id_tahun_ajar' => $idTahunAjar,
            'id_siswa' => $idSiswa,
            'id_semester' => $idSemester,
            'id_project' => $idProject,
        ]);

        // Ambil data untuk dropdown
        $clases = Kelas::all();
        $tahunajarans = tahun_ajaran::all();
        $semesters = Semester::all();
        $projects = Mbkm_siswa::all();

        // Filter siswa berdasarkan kelas yang dipilih
        $siswas = $idKelas ? Siswa::where('id_kelas_now', $idKelas)->get() : Siswa::all();

        // Filter data berdasarkan parameter yang diberikan
        $query = Raport_Mbkm::query();

        if ($idKelas) {
            $query->where('id_kelas', $idKelas);
        }

        if ($idTahunAjar) {
            $query->where('id_tahun_ajar', $idTahunAjar);
        }

        if ($idSiswa) {
            $query->where('id_siswa', $idSiswa);
        }

        if ($idSemester) {
            $query->where('id_semester', $idSemester);
        }
        if ($idProject) {
            $query->where('id_project', $idProject);
        }

        $nilai = $query->get();

        // Log data nilai
        Log::info('Filtered nilai data:', [
            'nilai' => $nilai->toArray(),
        ]);

        // Ambil data project dan fase

        $fases = CapaianFase::all();
        $predikat = RaportMbkmSiswa::all();

        return view('pages.user.nilai-projek', compact('idKelas', 'idTahunAjar', 'idSiswa', 'idSemester', 'idProject', 'nilai', 'projects', 'fases', 'predikat', 'clases', 'tahunajarans', 'siswas', 'semesters'));
    }


    public function storeJudulRaportMBKM(Request $request)
    {
        try {
            // Log the incoming request data
            Log::info('Storing Judul Raport MBKM', [
                'id_tahun_ajar' => $request->id_tahun_ajar,
                'id_semester' => $request->id_semester,
                'id_siswa' => $request->id_siswa,
                'id_kelas' => $request->id_kelas,
                'id_project' => $request->id_project,
            ]);

            // Validasi data yang diterima dari formulir
            $request->validate([
                'id_tahun_ajar' => 'required|exists:tahun_ajarans,id',
                'id_semester' => 'required|exists:semesters,id',
                'id_siswa' => 'required|exists:tbl_data_siswa,id',
                'id_kelas' => 'required|exists:kelas,id',
                'id_project' => 'required|exists:mbkm_siswas,id',
                'id_nilai' => 'nullable',
                'id_capaian' => 'nullable',
            ]);

            // Simpan data nilai ke dalam database
            Raport_Mbkm::create([
                'id_tahun_ajar' => $request->id_tahun_ajar,
                'id_semester' => $request->id_semester,
                'id_siswa' => $request->id_siswa,
                'id_kelas' => $request->id_kelas,
                'id_project' => $request->id_project,
                'id_nilai' => $request->id_nilai,
                'id_capaian' => $request->id_capaian
            ]);

            Log::info('Judul Raport MBKM stored successfully', [
                'id_tahun_ajar' => $request->id_tahun_ajar,
                'id_semester' => $request->id_semester,
                'id_siswa' => $request->id_siswa,
                'id_kelas' => $request->id_kelas,
                'id_project' => $request->id_project,
                'id_nilai' => $request->id_nilai,
                'id_capaian' => $request->id_capaian
            ]);

            return redirect()->back()->with('success', 'Nilai berhasil diperbarui');
        } catch (Exception $e) {
            // Log the exception details
            Log::error('Failed to store Judul Raport MBKM', [
                'error' => $e->getMessage(),
                'request' => $request->all()
            ]);

            // Redirect back with an error message
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan nilai. Silakan coba lagi.');
        }
    }
    public function storeNilai(Request $request)
    {

        try {
            // Log the incoming request data
            Log::info('Storing Raport MBKM', [
                'id_tahun_ajar' => $request->id_tahun_ajar,
                'id_semester' => $request->id_semester,
                'id_siswa' => $request->id_siswa,
                'id_kelas' => $request->id_kelas,
                'id_project' => $request->id_project,
                'id_nilai' => $request->id_nilai,
                'id_capaian' => $request->id_capaian,
            ]);

            // Validasi data yang diterima dari formulir
            $request->validate([
                'id_tahun_ajar' => 'required|exists:tahun_ajarans,id',
                'id_semester' => 'required|exists:semesters,id',
                'id_siswa' => 'required|exists:tbl_data_siswa,id',
                'id_kelas' => 'required|exists:kelas,id',
                'id_project' => 'required|exists:mbkm_siswas,id',
                'id_nilai' => 'required|exists:nilai_projek,id',
                'id_capaian' => 'required|exists:capaian_fases,id',
            ]);
            // Periksa jika id_capaian tidak ada atau null
            if (is_null($request->id_capaian)) {
                // Misalnya, tentukan nilai default atau log kesalahan
                Log::warning('id_capaian is null', ['request' => $request->all()]);
                // Set default value if necessary
                $id_capaian = 0; // Atau nilai default lain
            } else {
                $id_capaian = $request->id_capaian;
            }

            // Simpan data nilai ke dalam database
            Raport_Mbkm::create([
                'id_tahun_ajar' => $request->id_tahun_ajar,
                'id_semester' => $request->id_semester,
                'id_siswa' => $request->id_siswa,
                'id_kelas' => $request->id_kelas,
                'id_project' => $request->id_project,
                'id_nilai' => $request->id_nilai,
                'id_capaian' => $id_capaian
            ]);

            Log::info('NILAI Raport MBKM stored successfully', [
                'id_tahun_ajar' => $request->id_tahun_ajar,
                'id_semester' => $request->id_semester,
                'id_siswa' => $request->id_siswa,
                'id_kelas' => $request->id_kelas,
                'id_project' => $request->id_project,
                'id_nilai' => $request->id_nilai,
                'id_capaian' => $request->id_capaian
            ]);

            return redirect()->back()->with('success', 'Nilai berhasil diperbarui');
        } catch (Exception $e) {
            // Log the exception details
            Log::error('Failed to store Judul Raport MBKM', [
                'error' => $e->getMessage(),
                'request' => $request->all()
            ]);

            // Redirect back with an error message
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan nilai. Silakan coba lagi.');
        }
    }
    public function EditNilai(Request $request)
    {
        try {
            // Log the incoming request data
            Log::info('Request data :', $request->all());

            // Validasi data yang diterima dari formulir
            $request->validate([
                'id_tahun_ajar' => 'required|exists:tahun_ajarans,id',
                'id_semester' => 'required|exists:semesters,id',
                'id_siswa' => 'required|exists:tbl_data_siswa,id',
                'id_kelas' => 'required|exists:kelas,id',
                'id_project' => 'required|exists:mbkm_siswas,id',
                'id_nilai' => 'required|exists:nilai_projek,id',
                'id_capaian' => 'required|exists:capaian_fases,id',
            ]);

            // Periksa jika id_capaian tidak ada atau null
            if (is_null($request->id_capaian)) {
                Log::warning('id_capaian is null', ['request' => $request->all()]);
                // Set default value if necessary
                $id_capaian = 0; // Atau nilai default lain
            } else {
                $id_capaian = $request->id_capaian;
            }

            // Cari data berdasarkan id_project dan id_siswa untuk melakukan update
            $raportMbkm = Raport_Mbkm::where('id', $request->id)
                ->first();

            if ($raportMbkm) {
                // Jika data ditemukan, lakukan update
                $raportMbkm->update([
                    'id_tahun_ajar' => $request->id_tahun_ajar,
                    'id_semester' => $request->id_semester,
                    'id_kelas' => $request->id_kelas,
                    'id_nilai' => $request->id_nilai,
                    'id_capaian' => $id_capaian
                ]);
            } else {
                Log::info('DATA TIDAK DITEMUKAN');
            }

            return redirect()->back()->with('success', 'Nilai berhasil diperbarui');
        } catch (Exception $e) {
            // Log the exception details
            Log::error('Failed to store Judul Raport MBKM', [
                'error' => $e->getMessage(),
                'request' => $request->all()
            ]);

            // Redirect back with an error message
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan nilai. Silakan coba lagi.');
        }
    }

    // public function Storenilaipro(Request $request)
    // {
    //     $request->validate([
    //         'id_project' => 'required',
    //         'id_fase' => 'required',
    //         'nilai' => 'required|numeric',
    //     ]);

    //     $nilai = $request->input('nilai');
    //     $idProject = $request->input('id_project');
    //     $idFase = $request->input('id_fase');
    //     $idKelas = $request->input('id_kelas');
    //     $idTahunAjar = $request->input('id_tahun_ajar');
    //     $idSiswa = $request->input('id_siswa');
    //     $idSemester = $request->input('id_semester');

    //     Raport_Mbkm::updateOrCreate(
    //         ['id_project' => $idProject, 'id_fase' => $idFase, 'id_kelas' => $idKelas, 'id_tahun_ajar' => $idTahunAjar, 'id_siswa' => $idSiswa, 'id_semester' => $idSemester],
    //         ['nilai' => $nilai]
    //     );

    //     return redirect()->back()->with('success', 'Nilai berhasil diperbarui');
    // }

}
