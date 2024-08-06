<?php

namespace App\Http\Controllers;

use App\Models\Model_data_siswa\Mata_pelajaran;
use Illuminate\Http\Request;

class TPCPContoller extends Controller
{
    public function index() {
        $mapel = Mata_pelajaran::all();
        return view('pages.user.tpcp', [
            'mapel' => $mapel,
        ]);
    }

}
