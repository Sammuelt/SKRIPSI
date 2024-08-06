<?php

namespace App\Http\Controllers;

use App\Models\Model_laporan\Laporan_keuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class KeuanganController extends Controller
{
    public function index()
    {
        $keuangan = Laporan_keuangan::all();
        return view('pages.admin.keuangan', [
            'keuangan' => $keuangan,
        ]);
    }

    public function create()
    {
        return view('pages.admin.add-keuangan');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'tanggal' => 'required|date',
                'jenis_transaksi' => 'required|string|in:' . implode(',', Laporan_keuangan::$enumJenisTransaksi),
                'jumlah' => 'required|integer',
                'keterangan' => 'required|string|max:255',
            ]);
            Log::info('Validated data: ', $request->all());
    
            $aset = Laporan_keuangan::create([
                'tanggal' => $validated['tanggal'],
                'jenis_transaksi' => $validated['jenis_transaksi'],         
                'jumlah' => $validated['jumlah'],
                'keterangan' => $validated['keterangan'],
            ]);
    
            Log::info('Laporan Keuangan created:', $aset->toArray());
    
            return redirect(route('index.keuangan'))->with('success', 'Laporan Keuangan berhasil ditambahkan!!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed: ', $e->errors());
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Failed to create Laporan Keuangan: ', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan Laporan Keuangan.')->withInput();
        }
    }
    

    public function show( )
    {
        return view("pages.admin.edit-mapel");
    }
}
