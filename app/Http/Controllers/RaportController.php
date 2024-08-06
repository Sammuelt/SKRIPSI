<?php

namespace App\Http\Controllers;

use App\Models\CapaianFase;
use App\Models\Mbkm_siswa;
use App\Models\Model_data_siswa\Kehadiran;
use App\Models\Model_data_siswa\Kelas;
use App\Models\Model_data_siswa\Semester;
use App\Models\Model_data_siswa\Siswa;
use App\Models\Model_data_siswa\tahun_ajaran;
use App\Models\Model_raport\raport_ekstrakulikuler_siswa;
use App\Models\Model_raport\Raport_Mbkm;
use App\Models\Model_raport\Raport_siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RaportController extends Controller
{
    public function index()
    {
        $kelas = Kelas::with('walikelas')->get(); // Ambil semua data kelas beserta wali kelasnya
        return view('pages.admin.raport', compact('kelas'));
    }

    public function indexByKelas($id_kelas)
    {
        $kelas = Kelas::findOrFail($id_kelas);
        $siswa = Siswa::where('id_kelas_now', $id_kelas)->get();

        return view('pages.admin.raport-kelas', compact('kelas', 'siswa'));
    }
    public function showBySemester(Request $request)
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

        return view('pages.admin.raport-akademik', compact('student', 'dataRaports', 'dataekskul', 'datahadir', 'semesters', 'kelas', 'tahunajarans'));
    }

    public function showByAkademik($id, Request $request)
    {

        try {
            // Mendapatkan parameter semester dan tahun ajaran dari request
            $semesterId = $request->input('semester', 1);
            $tahunAjaranId = $request->input('tahunajaran', 4);

            // Menyusun request untuk showBySemester
            $request->merge([
                'semester' => $semesterId,
                'tahunajaran' => $tahunAjaranId,
                'student_id' => $id
            ]);

            // Memanggil showBySemester dan mengembalikan hasilnya
            return $this->showBySemester($request);
        } catch (\Exception $e) {
            // Handle jika data raport tidak ditemukan
            Log::error('Error menampilkan raport akademik', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Data raport tidak ditemukan.');
        }
    }

    public function showBySemesterMBKM(Request $request)
    {
        $semesterId = $request->input('semester', 1);
        $tahunAjaranId = $request->input('tahunajaran', 4);
        $studentId = $request->input('student_id');
    
        // Validasi ID siswa
        $student = Siswa::find($studentId);
        if (!$student) {
            return redirect()->back()->with('error', 'Siswa tidak ditemukan.');
        }
    
        $id_kelas_now = $student->id_kelas_now;
    
        // Ambil semua data semester dan tahun ajaran
        $semesters = Semester::all();
        $tahunajarans = tahun_ajaran::all();
    
        // Ambil data raport sesuai dengan semester dan tahun ajaran yang dipilih
        $dataRaports = Raport_Mbkm::where('id_siswa', $studentId)
            ->where('id_kelas', $id_kelas_now)
            ->when($semesterId, function ($query) use ($semesterId) {
                return $query->where('id_semester', $semesterId);
            })
            ->when($tahunAjaranId, function ($query) use ($tahunAjaranId) {
                return $query->where('id_tahun_ajar', $tahunAjaranId);
            })
            ->with(['semester', 'tahunAjaran', 'kelas', 'capaian_mbkm', 'project_Mbkm','nilai_Mbkm',])
            ->get();
    
        // Ambil semua data kelas
        $kelas = Kelas::all();
    
        $uniqueProjectTitles = $dataRaports->pluck('project_Mbkm.judul')->unique();
        $uniqueProjectSubTitles = $dataRaports->pluck('project_Mbkm.description')->unique();
        return view('pages.admin.raport-mbkm', compact('student', 'dataRaports', 'semesters', 'kelas', 'tahunajarans','uniqueProjectTitles','uniqueProjectSubTitles'));
    }
    
    public function showByMBKM($id, Request $request)
    {
        try {
            // Mendapatkan parameter semester dan tahun ajaran dari request
            $semesterId = $request->input('semester', 1);
            $tahunAjaranId = $request->input('tahunajaran', 4);
    
            // Menyusun request untuk showBySemester
            $request->merge([
                'semester' => $semesterId,
                'tahunajaran' => $tahunAjaranId,
                'student_id' => $id
            ]);
    
            // Memanggil showBySemester dan mengembalikan hasilnya
            return $this->showBySemesterMBKM($request);
        } catch (\Exception $e) {
            // Handle jika data raport tidak ditemukan
            Log::error('Error menampilkan raport MBKM', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Data raport MBKM tidak ditemukan.');
        }
    }
    
    public function inputByProjek()
    {
        return view("pages.user.mbkm-p5");
    }

    public function inputByMBKM()
    {
        return view("pages.user.raport-mbkm");
    }

}
