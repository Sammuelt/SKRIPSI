<?php

namespace App\Http\Controllers;

use App\Models\Model_data_siswa\Extrakulikuler;
use App\Models\Model_data_siswa\Mata_pelajaran;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function indexByAkademik() {
        $mapel = Mata_pelajaran::all();
        return view('pages.user.nilai-akademik', [
            'mapel' => $mapel,
        ]);
    }

    public function indexByEkskul() {
        $ekskul = Extrakulikuler::all();
        return view('pages.user.nilai-ekskul',[
            'ekskul' => $ekskul,
        ]);
    }

    public function indexByMBKM() {
        return view('pages.user.nilai-projek',);
    }

}
