<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kalender_Sekolah;
use App\Models\Model_data_siswa\semester;
use App\Models\Model_data_siswa\tahun_ajaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Exception;

class AdminController extends Controller
{
    public function index() {
        // Ambil tahun sekarang
        $tahunSekarang = date('Y');

        // Ambil semua record dari model Kalender_Sekolah
        $kalenderSekolah = Kalender_Sekolah::all();

        // Ambil data tahun ajaran yang sesuai dengan tahun sekarang atau lebih
        $tahunAjaran = tahun_ajaran::where('tahun_ajaran', '>=', $tahunSekarang)->get();

        // Ambil semua data semester
        $semester = semester::all();

        // Pass data ke view
        return view('pages.admin.dashboard', [
            'kalenderSekolah' => $kalenderSekolah,
            'tahunAjaran' => $tahunAjaran,
            'semester' => $semester
        ]);
    }


    public function index_guru() {
        return view("pages.admin.guru");

    }

    public function index_detail() {
        return view("pages.admin.detail-guru");
    }

    // kalender function

    public function create() {
        $TahunAjaran = tahun_ajaran::all();
        $Semester = semester::all();

        return view('pages.admin.add-kalender',
        [
            'tahunAjaran'=> $TahunAjaran,
            'semester' => $Semester

        ]);


    }
    // Function to store a new calendar entry
    public function store(Request $request){
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

public function createAkun(){
    $users = Guru::all();
    return view("pages.admin.add-akun", [
        'users' => $users
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
    ];

    // Define validation rules
    $rules = [
        'guru_id' => 'required|integer|exists:tbl_guru,id',
        'email' => 'required|string|max:255',
        'password' => 'required|string|max:255|confirmed',
    ];

    try {
        // Validate request
        $validator = Validator::make($request->all(), $rules, $messages);
        
        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }

        Log::info('Validated data: ', $request->all());

        // Create user
        $user = User::create([
            'id_user' => $request->input('guru_id'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        Log::info('User created: ', $user->toArray());

        return redirect(route('index.kalender'))->with('success', 'Data guru berhasil ditambahkan!!');
    } catch (Exception $e) {
        Log::error('Error creating user: ', ['error' => $e->getMessage()]);
        return redirect()->back()->with('error', 'Gagal menambahkan data guru! Silakan coba lagi.');
    }
}

}
