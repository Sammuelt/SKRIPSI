<?php

namespace App\Http\Controllers;

use App\Models\CapaianFase;
use App\Models\Kalender_Sekolah;
use App\Models\Mbkm_siswa;
use App\Models\Model_data_siswa\Extrakulikuler;
use App\Models\Model_data_siswa\Kehadiran;
use App\Models\Model_data_siswa\Kelas;
use App\Models\Model_data_siswa\Semester;
use App\Models\Model_data_siswa\Siswa;
use App\Models\Model_data_siswa\tahun_ajaran;
use App\Models\Model_raport\raport_ekstrakulikuler_siswa;
use App\Models\Model_raport\Raport_Mbkm;
use App\Models\Model_raport\Raport_siswa;
use App\Models\RaportMbkmSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RaportController extends Controller
{
    public function index(Request $request)
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


        // Query untuk data Raport_siswa
        $query = Raport_siswa::with(['siswa', 'kelas']);

        if ($idKelas) {
            $query->where('id_kelas', $idKelas);
        }

        if ($idTahunAjar) {
            $query->where('id_tahun_ajar', $idTahunAjar);
        }
        
        if ($idSemester) {
            $query->where('id_semester', $idSemester);
        }

        $siswas = $query->get()->groupBy('id_siswa')->map(function ($group) {
            return $group->first();
        })->values();

       

        return view('pages.admin.raport', compact( 'clases', 'tahunajarans', 'siswas', 'semesters'));
    }


    // public function indexByKelas($id_kelas)
    // {
    //     $kelas = Kelas::findOrFail($id_kelas);
    //     $siswa = Siswa::where('id_kelas_now', $id_kelas)->get();

    //     return view('pages.admin.raport-kelas', compact('kelas', 'siswa'));
    // }
    // public function showBySemester(Request $request)
    // {
    //     $semesterId = $request->input('semester', 1);
    //     $tahunAjaranId = $request->input('tahunajaran', 4);
    //     $studentId = $request->input('student_id');

    //     // Ambil semua data semester
    //     $semesters = Semester::all();

    //     // Ambil semua tahun ajaran
    //     $tahunajarans = tahun_ajaran::all();

    //     // Ambil data siswa berdasarkan student_id
    //     $student = Siswa::findOrFail($studentId);

    //     $id_kelas_now = $student->id_kelas_now;

    //     // Ambil data raport sesuai dengan semester dan tahun ajaran yang dipilih
    //     $dataRaports = Raport_siswa::where('id_siswa', $studentId)
    //         ->where('id_kelas', $id_kelas_now)
    //         ->when($semesterId, function ($query) use ($semesterId) {
    //             return $query->where('id_semester', $semesterId);
    //         })
    //         ->when($tahunAjaranId, function ($query) use ($tahunAjaranId) {
    //             return $query->where('id_tahun_ajar', $tahunAjaranId);
    //         })
    //         ->with(['semester', 'tahunAjaran', 'kelas', 'mapel'])
    //         ->get();

    //     // Ambil data raport ekstra sesuai dengan semester dan tahun ajaran yang dipilih
    //     $dataekskul = raport_ekstrakulikuler_siswa::where('id_siswa', $studentId)
    //         ->where('id_kelas', $id_kelas_now)
    //         ->when($semesterId, function ($query) use ($semesterId) {
    //             return $query->where('id_semester', $semesterId);
    //         })
    //         ->when($tahunAjaranId, function ($query) use ($tahunAjaranId) {
    //             return $query->where('id_tahun_ajar', $tahunAjaranId);
    //         })
    //         ->with(['semester', 'tahunAjaran', 'kelas', 'ekstrakulikuler'])
    //         ->get();

    //     // Ambil data kehadiran sesuai dengan semester dan tahun ajaran yang dipilih
    //     $datahadir = Kehadiran::where('id_siswa', $studentId)
    //         ->where('id_kelas', $id_kelas_now)
    //         ->when($semesterId, function ($query) use ($semesterId) {
    //             return $query->where('id_semester', $semesterId);
    //         })
    //         ->when($tahunAjaranId, function ($query) use ($tahunAjaranId) {
    //             return $query->where('id_tahun_ajar', $tahunAjaranId);
    //         })
    //         ->with(['semester', 'tahunAjaran', 'kelas'])
    //         ->get();

    //     // Ambil semua data kelas jika diperlukan
    //     $kelas = Kelas::all();

    //     return view('pages.admin.raport-akademik', compact('student', 'dataRaports', 'dataekskul', 'datahadir', 'semesters', 'kelas', 'tahunajarans'));
    // }

    public function showByAkademik($id,)
    {

        $data = Raport_siswa::findOrFail($id);



        // Ambil id_siswa dari data yang sudah diambil
        $siswa = $data->id_siswa;
        $kelas = $data->id_kelas;
        $semester = $data->id_semester;
        $tahun = $data->id_tahun_ajar;

        // Log informasi pengambilan data
        Log::info('Mengambil data Raport_siswa untuk siswa:', [
            'id_siswa' => $siswa,
            'id_kelas' => $kelas,
            'id_semester' => $semester,
            'id_tahun_ajar' => $tahun,
            'id_raport' => $id
        ]);


        $raports = Raport_siswa::where('id_siswa', $siswa)
            ->where('id_kelas', $kelas)
            ->where('id_semester', $semester)
            ->where('id_tahun_ajar', $tahun)
            ->with(['semester', 'tahunAjaran', 'kelas', 'siswa', 'mapel'])
            ->get();

        // Log hasil pengambilan data
        Log::info('Data Raport_siswa yang ditemukan:', [
            'jumlah' => $raports->count(),
            'data' => $raports
        ]);

        $ekskul = raport_ekstrakulikuler_siswa::where('id_siswa', $siswa)
        ->where('id_kelas', $kelas)
        ->where('id_semester', $semester)
        ->where('id_tahun_ajar', $tahun)
        ->with(['semester', 'tahunAjaran', 'kelas', 'siswa', 'mapel'])
        ->get();

        $datahadir = Kehadiran::where('id_siswa', $siswa)
        ->where('id_kelas', $kelas)
        ->where('id_semester', $semester)
        ->where('id_tahun_ajar', $tahun)
        ->with(['semester', 'tahunAjaran', 'kelas', 'siswa', 'mapel'])
        ->get();
        // Kembalikan ke view
        return view('pages.admin.raport-akademik', compact('raports', 'data','ekskul','datahadir','semester','id'));
    }

    // public function showBySemesterMBKM(Request $request)
    // {
    //     $semesterId = $request->input('semester', 1);
    //     $tahunAjaranId = $request->input('tahunajaran', 4);
    //     $studentId = $request->input('student_id');

    //     // Validasi ID siswa
    //     $student = Siswa::find($studentId);
    //     if (!$student) {
    //         return redirect()->back()->with('error', 'Siswa tidak ditemukan.');
    //     }

    //     $id_kelas_now = $student->id_kelas_now;

    //     // Ambil semua data semester dan tahun ajaran
    //     $semesters = Semester::all();
    //     $tahunajarans = tahun_ajaran::all();

    //     // Ambil data raport sesuai dengan semester dan tahun ajaran yang dipilih
    //     $dataRaports = Raport_Mbkm::where('id_siswa', $studentId)
    //         ->where('id_kelas', $id_kelas_now)
    //         ->when($semesterId, function ($query) use ($semesterId) {
    //             return $query->where('id_semester', $semesterId);
    //         })
    //         ->when($tahunAjaranId, function ($query) use ($tahunAjaranId) {
    //             return $query->where('id_tahun_ajar', $tahunAjaranId);
    //         })
    //         ->with(['semester', 'tahunAjaran', 'kelas', 'capaian_mbkm', 'project_Mbkm', 'nilai_Mbkm',])
    //         ->get();

    //     // Ambil semua data kelas
    //     $kelas = Kelas::all();

    //     $uniqueProjectTitles = $dataRaports->pluck('project_Mbkm.judul')->unique();
    //     $uniqueProjectSubTitles = $dataRaports->pluck('project_Mbkm.description')->unique();
    //     return view('pages.admin.raport-mbkm', compact('student', 'dataRaports', 'semesters', 'kelas', 'tahunajarans', 'uniqueProjectTitles', 'uniqueProjectSubTitles'));
    // }

    public function showByMBKM($id)
    {

        
        $data = Raport_Mbkm::findOrFail($id);
         // Ambil id_siswa dari data yang sudah diambil
         $siswa = $data->id_siswa;
         $kelas = $data->id_kelas;
         $semester = $data->id_semester;
         $tahun = $data->id_tahun_ajar;
 
         Log::info('Mengambil data Raport_siswa untuk siswa:', [
            'id_siswa' => $siswa,
            'id_kelas' => $kelas,
            'id_semester' => $semester,
            'id_tahun_ajar' => $tahun,
            'id_raport' => $id
        ]);


        $raports = Raport_Mbkm::where('id_siswa', $siswa)
            ->where('id_kelas', $kelas)
            ->where('id_semester', $semester)
            ->where('id_tahun_ajar', $tahun)
            ->with(['semester', 'tahunAjaran', 'kelas', 'siswa','nilai_Mbkm','capaian_mbkm','project_Mbkm'])
            ->get();

        // Log hasil pengambilan data
        Log::info('Data Raport_siswa yang ditemukan:', [
            'jumlah' => $raports->count(),
            'data' => $raports
        ]);
        $uniqueProjectTitles = $raports->pluck('project_Mbkm.judul')->unique();
            $uniqueProjectSubTitles = $raports->pluck('project_Mbkm.description')->unique();
            $uniqueProjectCP = $raports->pluck('project_Mbkm.capaian_proses')->unique();
            return view('pages.admin.raport-mbkm', compact( 'data','raports','uniqueProjectTitles', 'uniqueProjectSubTitles','uniqueProjectCP','id'));

    }


    //USER

    // Input Raport By User //
    // public function inputByAkademik()
    // {

    //     $kelas = Kelas::with("walikelas")->get();

    //     return view("pages.user.raport-akademik", compact('kelas'));
    // }

    // public function inputByKelas($id_kelas, Request $request)
    // {
    //     $kelas = Kelas::findOrFail($id_kelas);
    //     $siswa = Siswa::where('id_kelas_now', $id_kelas)->get();
    //     $idTahunAjar = $request->input('id_tahun_ajar');
    //     $idSemester = $request->input('id_semester');


    //     // Ambil semua data semester
    //     $semesters = Semester::all();

    //     // Ambil semua tahun ajaran
    //     $tahunajarans = tahun_ajaran::all();

    //     $query = Raport_siswa::query();


    //     if ($id_kelas) {
    //         $query->where('id_kelas', $id_kelas);
    //     }

    //     if ($idTahunAjar) {
    //         $query->where('id_tahun_ajar', $idTahunAjar);
    //     }

    //     if ($idSemester) {
    //         $query->where('id_semester', $idSemester);
    //     }

    //     $keteranganraport = $query->get();

    //     return view('pages.user.raport-kelas', compact('kelas', 'siswa', 'keteranganraport', 'semesters', 'tahunajarans'));
    // }
    public function filterRaport(Request $request)
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

        $ket = $query->get();

        // Ambil daftar mata pelajaran


        return view('pages.user.raport-akademik', compact('ket', 'clases', 'tahunajarans', 'siswas', 'semesters'));
    }



    public function showRaport($id, Request $request)
    {
        Log::info('Request Inputs:', $request->all());

        try {
            // Mendapatkan parameter semester, tahun ajaran, kelas, dan siswa dari request
            $idKelas = $request->input('id_kelas');
            $idTahunAjar = $request->input('id_tahun_ajar');
            $idSiswa = $id;
            $idSemester = $request->input('id_semester');



            // Log parameter yang diterima
            Log::info('Parameters received for showRaport', [
                'id_kelas' => $idKelas,
                'id_tahun_ajar' => $idTahunAjar,
                'id_siswa' => $idSiswa,
                'id_semester' => $idSemester
            ]);

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

            $dataRaports = $query->get();
            // Tambahkan di controller
            $dataekskuls = raport_ekstrakulikuler_siswa::where('id_siswa', $idSiswa)
                ->where('id_kelas', $idKelas)
                ->where('id_tahun_ajar', $idTahunAjar)
                ->where('id_semester', $idSemester)
                ->get();

            // Tambahkan di controller
            $datahadir = Kehadiran::where('id_siswa', $idSiswa)
                ->where('id_kelas', $idKelas)
                ->where('id_tahun_ajar', $idTahunAjar)
                ->where('id_semester', $idSemester)
                ->get();
            Log::info('Data kehadiran siswa', $datahadir->toArray());

            // Log jumlah data yang ditemukan
            Log::info('Data raport siswa', $dataRaports->toArray());


            $clases = Kelas::all();
            // Menampilkan data di view
            return view('pages.user.view-raport', compact('dataRaports', 'datahadir', 'dataekskuls', 'idSemester','clases','idSiswa'));
        } catch (\Exception $e) {
            // Log error dan redirect jika terjadi masalah
            Log::error('Error menampilkan raport akademik', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Data raport tidak ditemukan.');
        }
    }

    public function submitRaport(Request $request)
    {

        Log::info('Detail request untuk submitRaport', [
            'input' => $request->all(),
        ]);
        
        $idSiswa = $request->input('id_siswa');
        $idKelas = $request->input('naik');
        // Validasi data input
        $request->validate([
            'id_siswa' => 'required|exists:tbl_data_siswa,id', 
            'id_kelas' => 'nullable|exists:kelas,id', 
        ]);

        
        $siswa = Siswa::find($idSiswa);

      
        if (!$siswa) {
            return redirect()->back()->withErrors(['id_siswa' => 'Siswa tidak ditemukan']);
        }

      
        if ($idKelas) {
            Log::info("Memulai pembaruan kelas siswa", [
                'siswa_id' => $siswa->id,
                'kelas_lama' => $siswa->id_kelas_now,
                'kelas_baru' => $idKelas
            ]);
            $siswa->id_kelas_now = $idKelas;
            $siswa->save(); 

            Log::info("Kelas siswa berhasil diperbarui", [
                'siswa_id' => $siswa->id,
                'kelas_baru' => $idKelas
            ]);
        }

      
        return redirect()->route('filter.raport') 
                         ->with('success', 'Kelas siswa berhasil diperbarui');
    }


    public function FilterAll(Request $request)
    {
        $semesterId = $request->input('semester', 1);
        $tahunAjaranId = $request->input('tahunajaran', 4);
        $studentId = $request->input('student_id');

        // Ambil semua data semester
        $semesters = Semester::all();

        // Ambil semua tahun ajaran
        $tahunajarans = tahun_ajaran::all();

        // Ambil data siswa berdasarkan student_id
        $student = Siswa::findOrFail($studentId);

        $id_kelas_now = $student->id_kelas_now;

        // Ambil data raport sesuai dengan semester dan tahun ajaran yang dipilih
        $dataRaports = Raport_siswa::where('id_siswa', $studentId)
            ->where('id_kelas', $id_kelas_now)
            ->when($semesterId, function ($query) use ($semesterId) {
                return $query->where('id_semester', $semesterId);
            })
            ->when($tahunAjaranId, function ($query) use ($tahunAjaranId) {
                return $query->where('id_tahun_ajar', $tahunAjaranId);
            })
            ->with(['semester', 'tahunAjaran', 'kelas', 'mapel'])
            ->get();

        // Ambil data raport ekstra sesuai dengan semester dan tahun ajaran yang dipilih
        $dataekskul = raport_ekstrakulikuler_siswa::where('id_siswa', $studentId)
            ->where('id_kelas', $id_kelas_now)
            ->when($semesterId, function ($query) use ($semesterId) {
                return $query->where('id_semester', $semesterId);
            })
            ->when($tahunAjaranId, function ($query) use ($tahunAjaranId) {
                return $query->where('id_tahun_ajar', $tahunAjaranId);
            })
            ->with(['semester', 'tahunAjaran', 'kelas', 'ekstrakulikuler'])
            ->get();

        // Ambil data kehadiran sesuai dengan semester dan tahun ajaran yang dipilih
        $datahadir = Kehadiran::where('id_siswa', $studentId)
            ->where('id_kelas', $id_kelas_now)
            ->when($semesterId, function ($query) use ($semesterId) {
                return $query->where('id_semester', $semesterId);
            })
            ->when($tahunAjaranId, function ($query) use ($tahunAjaranId) {
                return $query->where('id_tahun_ajar', $tahunAjaranId);
            })
            ->with(['semester', 'tahunAjaran', 'kelas'])
            ->get();

        // Ambil semua data kelas jika diperlukan
        $kelas = Kelas::all();

        return view('pages.user.view-raport', compact('student', 'dataRaports', 'dataekskul', 'datahadir', 'semesters', 'kelas', 'tahunajarans'));
    }
  


    public function inputByProjek(Request $request)
    {
        // Ambil nilai pencarian dari query string
        $searchTerm = $request->input('search');
    
        // Ambil semua data proyek dan fase
        $projects = Mbkm_siswa::query();
        $fases = CapaianFase::all();
    
        // Jika ada nilai pencarian, filter hasil
        if ($searchTerm) {
            $projects->where('judul', 'like', '%' . $searchTerm . '%'); 
        }
    
        // Ambil hasil pencarian
        $projects = $projects->get();
    
        return view('pages.user.mbkm-p5', compact('projects', 'fases'));
    }
    
    public function createByProjek()
    {
        return view("pages.user.add-project-p5");
    }
    public function storeProject(Request $request)
    { {
            $request->validate([
                'judul' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'capaian_proses' => 'required|string|max:255',
            ]);

            // Log validated data
            Log::info('Validated data for storing mata pelajaran:', $request->all());

            try {
                $projek = Mbkm_siswa::create([
                    'judul' => $request->input('judul'),
                    'description' => $request->input('description'),
                    'capaian_proses' => $request->input('capaian_proses'),
                ]);

                // Log success message
                Log::info('Mata pelajaran berhasil ditambahkan:', $projek->toArray());

                return redirect(route('index.p5'))->with('success', 'Data mata pelajaran berhasil ditambahkan!');
            } catch (\Exception $e) {
                // Log error message
                Log::error('Gagal menambahkan data mata pelajaran: ' . $e->getMessage());
                return redirect()->back()->withInput()->with('error', 'Gagal menambahkan data mata pelajaran. Silakan coba lagi.');
            }
            return view("pages.user.mbkm-p5");
        }
    }

    public function updateProject(Request $request, $id) {
        $request->validate([
            'description' => 'required|string',
            'capaian_proses' => 'required|string',
        ]);

        $project = Mbkm_siswa::findOrFail($id);
        $project->update([
            'description' => $request->input('description'),
            'capaian_proses' => $request->input('capaian_proses'),
        ]);

        return redirect()->route('index.p5')->with('success', 'Projek berhasil diperbarui.');
    }
    public function destroyProject($id) {
    

        $project = Mbkm_siswa::findOrFail($id);
        $project->delete();

        return redirect()->route('index.p5')->with('success',  'Projek berhasil dihapus.');
    }


    // public function storeraport(Request $request)
    // {

    //     {
    //         $request->validate([
    //             'judul' => 'required|string|max:255',
    //             'description' => 'required|string|max:255',
    //             'capaian_proses' => 'required|string|max:255',
    //         ]);

    //         // Log validated data
    //         Log::info('Validated data for storing mata pelajaran:', $request->all());

    //         try {
    //             $projek = Mbkm_siswa::create([
    //                 'judul' => $request->input('judul'),
    //                 'description' => $request->input('description'),
    //                 'capaian_proses' => $request->input('capaian_proses'),
    //             ]);

    //             // Log success message
    //             Log::info('Mata pelajaran berhasil ditambahkan:', $projek->toArray());

    //             return redirect(route('index.p5'))->with('success', 'Data mata pelajaran berhasil ditambahkan!');
    //         } catch (\Exception $e) {
    //             // Log error message
    //             Log::error('Gagal menambahkan data mata pelajaran: ' . $e->getMessage());
    //             return redirect()->back()->withInput()->with('error', 'Gagal menambahkan data mata pelajaran. Silakan coba lagi.');
    //         }
    //     return view("pages.user.mbkm-p5");
    // }}



    public function inputByMBKM(Request $request)
    { {
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

            return view('pages.user.raport-mbkm', compact('idKelas', 'idTahunAjar', 'idSiswa', 'idSemester', 'idProject', 'nilai', 'projects', 'fases', 'predikat', 'clases', 'tahunajarans', 'siswas', 'semesters'));
        }
    }

    public function storeKehadiran(Request $request)
    {
        // Validasi data yang dikirimkan
        $validatedData = $request->validate([
            'id_tahun_ajar' => 'required|integer',
            'id_semester' => 'required|integer',
            'id_siswa' => 'required|integer',
            'id_kelas' => 'required|integer',
            'sakit' => 'required|integer',
            'izin' => 'required|integer',
            'alpha' => 'required|integer',
        ]);

        // Log data yang diterima
        Log::info('Menyimpan data kehadiran', $validatedData);

        try {
            // Simpan data kehadiran
            $kehadiran = new Kehadiran();
            $kehadiran->id_tahun_ajar = $validatedData['id_tahun_ajar'];
            $kehadiran->id_semester = $validatedData['id_semester'];
            $kehadiran->id_siswa = $validatedData['id_siswa'];
            $kehadiran->id_kelas = $validatedData['id_kelas'];
            $kehadiran->sakit = $validatedData['sakit'];
            $kehadiran->izin = $validatedData['izin'];
            $kehadiran->alpha = $validatedData['alpha'];
            $kehadiran->save();

            // Log informasi setelah berhasil disimpan
            Log::info('Data kehadiran berhasil disimpan', ['id' => $kehadiran->id]);

            // Redirect atau kembali dengan pesan sukses
            return redirect()->back()->with('success', 'Kehadiran berhasil ditambahkan!');
        } catch (\Exception $e) {
            // Log jika terjadi error
            Log::error('Gagal menyimpan data kehadiran', ['error' => $e->getMessage()]);

            // Redirect atau kembali dengan pesan error
            return redirect()->back()->with('error', 'Gagal menambahkan kehadiran.');
        }
    }
}
