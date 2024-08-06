<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kalender_Sekolah;
use App\Models\Model_data_siswa\semester;
use App\Models\Model_data_siswa\tahun_ajaran;
use Illuminate\Http\Request;

class UserController extends Controller
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
        return view('pages.user.dashboard', [
            'kalenderSekolah' => $kalenderSekolah,
            'tahunAjaran' => $tahunAjaran,
            'semester' => $semester
        ]);
    }
    public function show() {
        $guru = Guru::first();
        return view('pages.user.show-akun', ['guru' => $guru]);
    }

}
