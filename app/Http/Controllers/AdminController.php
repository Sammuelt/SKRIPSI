<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kalender_Sekolah;
use App\Models\Model_data_siswa\semester;
use App\Models\Model_data_siswa\Siswa;
use App\Models\Model_data_siswa\tahun_ajaran;
use App\Models\Prestasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
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
        return view('pages.admin.dashboard', [
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

        return view("pages.admin.prestasi", [ 
            'prestasi' => $prestasi,
            'siswa' => $siswa
        ]);
    }

    public function createPrestasi(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'siswa' => 'required|exists:tbl_data_siswa,id',
            'title' => 'required|string|max:255',
            'nama_lomba' => 'required|string|max:255',
            'date' => 'required|date',
            'ket' => 'required|string|max:500',
        ]);

        // Log data yang diterima
        Log::info('Menerima permintaan untuk menambahkan prestasi:', $validated);

        try {
            // Simpan data ke database
            Prestasi::create([
                'id_siswa' => $validated['siswa'],
                'title' => $validated['title'],
                'sub' => $validated['nama_lomba'],
                'date' => $validated['date'],
                'ket' => $validated['ket'],
            ]);

            // Log keberhasilan penyimpanan
            Log::info('Prestasi berhasil ditambahkan.', [
                'siswa_id' => $validated['siswa'],
                'title' => $validated['title'],
                'sub' => $validated['nama_lomba'],
                'date' => $validated['date'],
                'ket' => $validated['ket'],
            ]);

            // Redirect atau respons sukses
            return redirect()->route('prestasi.index')->with('success', 'Prestasi berhasil ditambahkan.');

        } catch (\Exception $e) {
            // Log kesalahan jika terjadi
            Log::error('Gagal menambahkan prestasi:', [
                'error' => $e->getMessage(),
                'request_data' => $validated
            ]);

            // Redirect atau respons kesalahan
            return redirect()->route('prestasi.index')->with('error', 'Gagal menambahkan prestasi.');
        }
    }



    public function index_guru()
    {
        return view("pages.admin.guru");
    }

    public function index_detail()
    {
        return view("pages.admin.detail-guru");
    }

    // kalender function

    public function create()
    {
        $TahunAjaran = tahun_ajaran::all();
        $Semester = semester::all();

        return view(
            'pages.admin.add-kalender',
            [
                'tahunAjaran' => $TahunAjaran,
                'semester' => $Semester

            ]
        );
    }
    // Function to store a new calendar entry
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'id_tahun_ajaran' => 'required',
            'id_semester' => 'required',
            'keterangan' => 'required|string',
            'tanggal' => 'required|date',
        ]);

        // Buat instance baru dari model Kalender_Sekolah
        $kalender = new Kalender_Sekolah();
        $kalender->id_tahun_ajaran = $request->input('id_tahun_ajaran');
        $kalender->id_semester = $request->input('id_semester');
        $kalender->keterangan = $request->input('keterangan');
        $kalender->tanggal = $request->input('tanggal');
        // Atur nilai-nilai field lainnya sesuai kebutuhan

        // Simpan entri kalender baru
        $kalender->save();
        // Log activity
        Log::info('Kalender Sekolah ditambahkan: ' . $kalender->id);

        // Redirect ke route atau tampilkan view setelah berhasil menyimpan
        return redirect()->route('index.kalender');
    }

    public function createAkun()
    {
        $users = Guru::all();
        $wali = Siswa::all();
        return view("pages.admin.add-akun", [
            'users' => $users,
            'wali' => $wali
        ]);
    }

    public function storeAkun(Request $request)
    {
        // Custom messages for validation
        $messages = [
            'required' => 'Kolom :attribute wajib diisi.',
            'integer' => 'Kolom :attribute harus berupa angka.',
            'string' => 'Kolom :attribute harus berupa teks.',
            'max' => 'Kolom :attribute tidak boleh lebih dari :max karakter.',
            'confirmed' => 'Kolom :attribute konfirmasi tidak cocok.',
            'exists' => 'Data yang dipilih tidak ditemukan.',
            'email' => 'Kolom :attribute harus berupa alamat email yang valid.',
        ];
    
        // Get the role from the request
        $role = $request->input('role');
    
        // Define base validation rules
        $rules = [
            'role' => 'required|in:user,wali',
            'guru_id' => 'integer|exists:tbl_guru,id',
            'wali_id' => 'integer|exists:tbl_data_siswa,id', // Assuming you have a tbl_wali table
            'email' => 'string|max:255|email',
            'phone' => 'string|max:20', // Assuming phone number length
            'password' => 'required|string|min:8|max:255|confirmed',
        ];
    
        // Apply conditional validation rules
        if ($role === 'user') {
            $rules['guru_id'] = 'required|integer|exists:tbl_guru,id';
            $rules['email'] = 'required|string|max:255|email';
            unset($rules['wali_id']);
            unset($rules['phone']);
        } elseif ($role === 'wali') {
            $rules['wali_id'] = 'required|integer|exists:tbl_data_siswa,id';
            $rules['phone'] = 'required|string|max:20';
            unset($rules['guru_id']);
            unset($rules['email']);
        }
    
        try {
            // Log the incoming request data
            Log::info('Incoming request data: ', $request->all());
    
            // Validate request
            $validator = Validator::make($request->all(), $rules, $messages);
    
            if ($validator->fails()) {
                // Log validation errors
                Log::warning('Validation failed: ', $validator->errors()->toArray());
    
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
    
            Log::info('Validated data: ', $request->all());
    
            // Determine which type of user to create
            if ($role === 'user') {
                $user = User::create([
                    'id_user' => $request->input('guru_id'),
                    'email' => $request->input('email'),
                    'password' => Hash::make($request->input('password')),
                    'role' =>$request->input('role')
                ]);
            } elseif ($role === 'wali') {
                $user = User::create([
                    'id_wali' => $request->input('wali_id'),
                    'email' => $request->input('phone'),
                    'password' => Hash::make($request->input('password')),
                    'role' =>$request->input('role')
                ]);
            }
    
            // Log the created user data
            Log::info('User created: ', $user->toArray());
    
            return redirect(route('index.kalender'))->with('success', 'Data akun berhasil ditambahkan!!');
        } catch (Exception $e) {
            // Log exception details
            Log::error('Error creating user: ', ['error' => $e->getMessage()]);
    
            return redirect()->back()->with('error', 'Gagal menambahkan data akun! Silakan coba lagi.');
        }
    }

    public function showAkun()
    {
        // Mendapatkan informasi akun pengguna yang sedang login
        $user = Auth::user();

        // Log informasi pengguna yang sedang login
        Log::info('Logged in user information:', ['user' => $user]);

        // Memeriksa jika $user tidak null
        if ($user) {
            $email = $user->email;
            $guruId = $user->id_user;

            // Log email dan id_user dari pengguna
            Log::info('User email:', ['email' => $email]);
            Log::info('User ID:', ['guru_id' => $guruId]);

            // Ambil data Guru berdasarkan email
            $guru = Guru::where('id', $guruId)->first();

            // Log data Guru yang ditemukan
            if ($guru) {
                Log::info('Guru data found:', ['guru' => $guru]);
            } else {
                Log::info('No Guru data found for email:', ['email' => $email]);
            }

            // Mengirimkan data akun dan data guru ke view
            return view('pages.auth.show-akun', [
                'user' => $user,
                'guru' => $guru, // Mengirimkan data Guru ke view
            ]);
        } else {
            // Log jika pengguna tidak ditemukan
            Log::warning('User not found during account retrieval.');

            // Menangani kasus jika pengguna tidak ditemukan
            return redirect()->route('login')->withErrors('User not found.');
        }
    }
}
