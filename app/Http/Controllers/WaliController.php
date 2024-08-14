<?php

namespace App\Http\Controllers;

use App\Models\Kalender_Sekolah;
use App\Models\Model_data_siswa\Kehadiran;
use App\Models\Model_data_siswa\Kelas;
use App\Models\Model_data_siswa\semester;
use App\Models\Model_data_siswa\Siswa;
use App\Models\Model_data_siswa\tahun_ajaran;
use App\Models\Model_raport\raport_ekstrakulikuler_siswa;
use App\Models\Model_raport\Raport_Mbkm;
use App\Models\Model_raport\Raport_siswa;
use App\Models\Prestasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use PgSql\Lob;

class WaliController extends Controller
{


    public function index()
    {
        // Ambil tahun sekarang
        $tahunSekarang = date('Y');

        // Ambil semua record dari model Kalender_Sekolah
        $kalenderSekolah = Kalender_Sekolah::all();

        // Ambil data tahun ajaran yang sesuai dengan tahun sekarang atau lebih
        $tahunAjaran = tahun_ajaran::where('tahun_ajaran', '>=', $tahunSekarang)->get();

        // Ambil semua data semester
        $semester = semester::all();

        $prestasi = Prestasi::latest()->with('siswa')->take(5)->get();

        // Pass data ke view
        return view('pages.wali-murid.dashboard', [
            'kalenderSekolah' => $kalenderSekolah,
            'tahunAjaran' => $tahunAjaran,
            'semester' => $semester,
            'prestasi' => $prestasi
        ]);
    }
    public function prestasi()
    {
        $prestasi = Prestasi::all();

        $siswa = Siswa::all();

        return view("pages.wali-murid.prestasi", [
            'prestasi' => $prestasi,
            'siswa' => $siswa
        ]);
    }


    public function RaportAkademik(Request $request)
    {
        try {
            $user = Auth::user();
            $email = $user->email;

            // Log email pengguna
            Log::info('Email pengguna:', ['email' => $email]);

            // Cari data siswa berdasarkan email
            $idsiswa = Siswa::where('no_hp_ortu', $email)->first();

            if ($idsiswa) {
                $id = $idsiswa->id;
                // Log ID siswa yang ditemukan
                Log::info('Siswa ditemukan:', ['id_siswa' => $id]);
            } else {
                // Log jika data siswa tidak ditemukan
                Log::warning('Siswa tidak ditemukan dengan no_hp_ortu:', ['email' => $email]);
                $id = null; // Atau tangani kasus ini sesuai kebutuhan
            }

            // Validasi parameter request
            $validatedData = $request->validate([
                'id_kelas' => 'nullable|exists:kelas,id',
                'id_tahun_ajar' => 'nullable|exists:tahun_ajarans,id',
                'id_semester' => 'nullable|exists:semesters,id',
            ]);

            $idKelas = $validatedData['id_kelas'] ?? null;
            $idTahunAjar = $validatedData['id_tahun_ajar'] ?? null;
            $idSemester = $validatedData['id_semester'] ?? null;

            // Log parameter yang diterima
            Log::info('Parameter request diterima:', [
                'id_kelas' => $idKelas,
                'id_tahun_ajar' => $idTahunAjar,
                'id_semester' => $idSemester
            ]);

            // Ambil data dari model terkait
            $clases = Kelas::all();
            $tahunajarans = Tahun_ajaran::all();
            $semesters = Semester::all();

            // Mulai query dengan eager loading relasi
            $query = Raport_siswa::query();

            if ($idKelas) {
                $query->where('id_kelas', $idKelas);
            }

            if ($idTahunAjar) {
                $query->where('id_tahun_ajar', $idTahunAjar);
            }

            if ($id) {
                $query->where('id_siswa', $id);
            }

            if ($idSemester) {
                $query->where('id_semester', $idSemester);
            }

            // Ambil data raport
            $dataRaport = $query->with(['siswa', 'kelas', 'tahunAjaran', 'semester'])->get();

            $dataekskuls = raport_ekstrakulikuler_siswa::where('id_siswa', $id)
                ->where('id_kelas', $idKelas)
                ->where('id_tahun_ajar', $idTahunAjar)
                ->where('id_semester', $idSemester)
                ->get();

            $datahadir = Kehadiran::where('id_siswa', $id)
                ->where('id_kelas', $idKelas)
                ->where('id_tahun_ajar', $idTahunAjar)
                ->where('id_semester', $idSemester)
                ->get();
            // Log hasil query
            Log::info('Data raport ditemukan:', ['data_raport' => $dataRaport]);

            Log::info('Data ekskul ditemukan:', ['data ekskul' => $dataekskuls]);

            Log::info('Data hadir ditemukan:', ['data ekskul' => $datahadir]);

            // Kirim data ke view
            return view("pages.wali-murid.raport-akademik", [
                'clases' => $clases,
                'tahunajarans' => $tahunajarans,
                'semesters' => $semesters,
                'idsiswa' => $idsiswa,
                'dataRaport' => $dataRaport,
                'dataekskuls' => $dataekskuls,
                'datahadir' => $datahadir,
                'idSemester' => $idSemester,
            ]);
        } catch (\Exception $e) {
            // Log exception
            Log::error('Error dalam RaportAkademik:', ['error' => $e->getMessage()]);

            // Tangani error dan tampilkan pesan yang sesuai
            return redirect()->back()->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }
    public function RaportProyek(Request $request)
    {
        try {
            $user = Auth::user();
            $email = $user->email;

            // Log email pengguna
            Log::info('Email pengguna:', ['email' => $email]);

            // Cari data siswa berdasarkan email
            $idsiswa = Siswa::where('no_hp_ortu', $email)->first();

            if ($idsiswa) {
                $id = $idsiswa->id;
                // Log ID siswa yang ditemukan
                Log::info('Siswa ditemukan:', ['id_siswa' => $id]);
            } else {
                // Log jika data siswa tidak ditemukan
                Log::warning('Siswa tidak ditemukan dengan no_hp_ortu:', ['email' => $email]);
                $id = null; // Atau tangani kasus ini sesuai kebutuhan
            }

            // Validasi parameter request
            $validatedData = $request->validate([
                'id_kelas' => 'nullable|exists:kelas,id',
                'id_tahun_ajar' => 'nullable|exists:tahun_ajarans,id',
                'id_semester' => 'nullable|exists:semesters,id',
            ]);

            $idKelas = $validatedData['id_kelas'] ?? null;
            $idTahunAjar = $validatedData['id_tahun_ajar'] ?? null;
            $idSemester = $validatedData['id_semester'] ?? null;

            // Log parameter yang diterima
            Log::info('Parameter request diterima:', [
                'id_kelas' => $idKelas,
                'id_tahun_ajar' => $idTahunAjar,
                'id_semester' => $idSemester
            ]);

            // Ambil data dari model terkait
            $clases = Kelas::all();
            $tahunajarans = Tahun_ajaran::all();
            $semesters = Semester::all();

            // Mulai query dengan eager loading relasi
            $query = Raport_Mbkm::query();

            if ($idKelas) {
                $query->where('id_kelas', $idKelas);
            }

            if ($idTahunAjar) {
                $query->where('id_tahun_ajar', $idTahunAjar);
            }

            if ($id) {
                $query->where('id_siswa', $id);
            }

            if ($idSemester) {
                $query->where('id_semester', $idSemester);
            }

            // Ambil data raport
            $dataRaport = $query->with(['siswa', 'kelas', 'tahunAjaran', 'semester', 'project_Mbkm', 'capaian_mbkm', 'nilai_Mbkm'])->get();

            $uniqueProjectTitles = $dataRaport->pluck('project_Mbkm.judul')->unique();
            $uniqueProjectSubTitles = $dataRaport->pluck('project_Mbkm.description')->unique();
            $uniqueProjectCP = $dataRaport->pluck('project_Mbkm.capaian_proses')->unique();


            // Log hasil query
            Log::info('Data raport ditemukan:', ['data_raport' => $dataRaport]);


            // Kirim data ke view
            return view("pages.wali-murid.raport-MBKM", [
                'clases' => $clases,
                'tahunajarans' => $tahunajarans,
                'semesters' => $semesters,
                'idsiswa' => $idsiswa,
                'dataRaport' => $dataRaport,
                'idSemester' => $idSemester,
                'uniqueProjectTitles' => $uniqueProjectTitles,
                'uniqueProjectSubTitles' => $uniqueProjectSubTitles,
                'uniqueProjectCP' => $uniqueProjectCP,
            ]);
        } catch (\Exception $e) {
            // Log exception
            Log::error('Error dalam RaportAkademik:', ['error' => $e->getMessage()]);

            // Tangani error dan tampilkan pesan yang sesuai
            return redirect()->back()->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }


    public function DetailAkun()
    {
        $user = Auth::user();

        Log::info('Informasi pengguna yang sedang login:', ['user' => $user]);


  
        if ($user) {
          
            if ($user->role == 'Wali') {
              
                Log::info('Informasi pengguna yang sedang login:', ['user' => $user]);

                $email = $user->email;

              
                Log::info('Email pengguna:', ['email' => $email]);

               
                $siswa = Siswa::where('no_hp_ortu', $email)->first();

                $Walikelas = [];
                if ($siswa) {
                    $idKelas = $siswa->id_kelas_now;

                    $Walikelas = Kelas::where('id', $idKelas)->with('walikelas')->get();

                   
                } else {
                    // Tangani kasus ketika data siswa tidak ditemukan
                    $idKelas = null;
                }

                // Log data Siswa yang ditemukan atau tidak ditemukan
                Log::info($siswa ? 'Data Siswa ditemukan:' : 'Tidak orangtua dengan nomor:', ['siswa' => $siswa, 'email' => $email]);

                // Mengirimkan data akun dan data siswa ke view
                return view('pages.wali-murid.detail-akun', [
                    'user' => $user,
                    'siswa' => $siswa, 
                    'Walikelas' => $Walikelas,
                ]);
            } else {
                // Log jika pengguna tidak memiliki peran wali
                Log::warning('Pengguna tidak memiliki akses ke halaman ini karena bukan peran wali.', [
                    'user' => $user,
                    'role' => $user->role // Menampilkan role pada akun tersebut
                ]);

                // Mengalihkan ke halaman lain atau menampilkan pesan kesalahan
                return redirect()->route('index.wali')->withErrors('Anda tidak memiliki akses ke halaman ini.');
            }
        } else {
            // Log jika pengguna tidak ditemukan
            Log::warning('Pengguna tidak ditemukan saat pengambilan detail akun.');

            // Menangani kasus jika pengguna tidak ditemukan
            return redirect()->route('index.wali')->withErrors('Pengguna tidak ditemukan.');
        }
    }


    public function EditAkun($id)
    {

        $siswa = Siswa::findOrFail($id);
        return view('pages.wali-murid.edit-data', compact('siswa'));
    }

    public function UpdateAkun(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|in:laki-laki,perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'nama_orang_tua' => 'required|string|max:255',
            'no_hp_ortu' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
        ]);

        // Cari data siswa berdasarkan ID
        $siswa = Siswa::findOrFail($id);

        // Simpan data sebelum update untuk log
        $oldNoHpOrtu = $siswa->no_hp_ortu;

        // Update data siswa
        $siswa->nama_lengkap = $request->input('nama_lengkap');
        $siswa->jenis_kelamin = $request->input('jenis_kelamin');
        $siswa->tempat_lahir = $request->input('tempat_lahir');
        $siswa->tanggal_lahir = $request->input('tanggal_lahir');
        $siswa->nama_orang_tua = $request->input('nama_orang_tua');
        $siswa->no_hp_ortu = $request->input('no_hp_ortu');
        $siswa->alamat = $request->input('alamat');

        // Simpan perubahan ke database
        $siswa->save();

        // Logging data perubahan untuk no_hp_ortu
        $newNoHpOrtu = $siswa->no_hp_ortu;

        Log::info('Data siswa diperbarui', [
            'user_id' => auth()->id(), // ID user yang melakukan update
            'siswa_id' => $siswa->id,  // ID siswa yang diupdate
            'old_no_hp_ortu' => $oldNoHpOrtu, // No HP Ortus lama
            'new_no_hp_ortu' => $newNoHpOrtu, // No HP Ortus baru
        ]);

        // Jika no_hp_ortu lama diubah, cari User yang memiliki no_hp_ortu lama dan update emailnya
        $user = User::where('email', $oldNoHpOrtu)->first();
        if ($user) {
            // Ganti email pada User
            $user->email = $newNoHpOrtu; // Set email baru sesuai kebutuhan
            $user->save();

            Log::info('Email User diperbarui', [
                'user_id' => $user->id,
                'old_no_hp_ortu' => $oldNoHpOrtu,
                'new_email' => $user->email
            ]);
        }

        return redirect()->route('detail.index.wali')->with('success', 'Data siswa berhasil diperbarui!');
    }
    public function GantiPw()
    {
        $user = Auth::user();

        // Ambil email pengguna
        $email = $user->email;

        return view('pages.wali-murid.ganti-pw', compact('user', 'email'));
    }

    public function updatePW(Request $request)
    {
        try {
            // Log request data untuk debug
            Log::info('Request data:', $request->all());

            // Validasi input
            $validatedData = $request->validate([
                'pw' => 'required|string|min:8',
                'email' => 'required|string',
            ]);

            // Log data yang sudah divalidasi
            Log::info('Validated data:', $validatedData);

            // Temukan pengguna berdasarkan email
            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return redirect()->route('index.wali')->with('error', 'Email tidak ditemukan!');
            }

            // Log data pengguna sebelum diperbarui
            Log::info('User data before update:', $user->toArray());

            // Perbarui password jika berbeda dari password lama
            $user->password = bcrypt($validatedData['pw']);
            $user->save();

            // Log data pengguna setelah diperbarui
            Log::info('User data after update:', $user->toArray());

            // Redirect dengan pesan sukses
            return redirect()->route('index.wali')->with('success', 'Password berhasil diperbarui!');
        } catch (\Exception $e) {
            // Log exception jika terjadi kesalahan
            Log::error('Error updating password:', ['message' => $e->getMessage()]);

            // Redirect dengan pesan error
            return redirect()->route('index.wali')->with('error', 'Terjadi kesalahan saat memperbarui password!');
        }
    }
}
