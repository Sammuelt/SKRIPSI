<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuratController extends Controller
{
    public function index_mutasi() {
        return view('pages.admin.add-surat-mutasi');
    }

    public function show_mutasi() {
        return view('pages.print-out.surat-mutasi');
    }
}

