<?php

namespace App\Http\Controllers;

use App\Models\Model_data_siswa\tahun_ajaran;
use App\Models\Model_laporan\Inventaris_barang;
use App\Models\Model_laporan\Laporan_keuangan;
use App\Models\PerencanaanDana;
use App\Models\SaldoKeuangan;
use App\Models\StandartHarga;
use Carbon\Carbon;
use Exception;
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
            // Validasi input
            $validated = $request->validate([
                'tanggal' => 'required|date',
                'jenis_transaksi' => 'required|string|in:' . implode(',', Laporan_keuangan::$enumJenisTransaksi),
                'dana' => 'required|string|in:' . implode(',', Laporan_keuangan::$enumDana),
                'jumlah' => 'required|integer',
                'keterangan' => 'required|string|max:255',
            ]);
            Log::info('Validated data: ', $request->all());

            // Buat laporan keuangan baru
            $aset = Laporan_keuangan::create([
                'tanggal' => $validated['tanggal'],
                'jenis_transaksi' => $validated['jenis_transaksi'],
                'dana' => $validated['dana'],
                'jumlah' => $validated['jumlah'],
                'keterangan' => $validated['keterangan'],
            ]);

            // Ambil saldo keuangan
            $saldo = SaldoKeuangan::first();
            if (!$saldo) {
                // Jika tidak ada saldo, buat baru
                $saldo = SaldoKeuangan::create([
                    'Saldo_semua' => 0,
                    'Saldo_bos' => 0,
                    'Saldo_lain' => 0,
                ]);
            }

            // Update saldo berdasarkan jenis transaksi dan dana
            if ($validated['jenis_transaksi'] == 'uang_masuk') {
                if ($validated['dana'] == 'Dana Bos') {
                    $saldo->Saldo_bos += $validated['jumlah'];
                } else {
                    $saldo->Saldo_lain += $validated['jumlah'];
                }
                $saldo->Saldo_semua += $validated['jumlah'];
            } else if ($validated['jenis_transaksi'] == 'uang_keluar') {
                if ($validated['dana'] == 'Dana Bos') {
                    $saldo->Saldo_bos -= $validated['jumlah'];
                } else {
                    $saldo->Saldo_lain -= $validated['jumlah'];
                }
                $saldo->Saldo_semua -= $validated['jumlah'];
            }

            // Simpan saldo yang sudah diupdate
            $saldo->save();

            Log::info('Laporan Keuangan created:', $aset->toArray());
            Log::info('Saldo updated:', $saldo->toArray());

            return redirect(route('index.keuangan'))->with('success', 'Laporan Keuangan berhasil ditambahkan!!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed: ', $e->errors());
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Failed to create Laporan Keuangan: ', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan Laporan Keuangan.')->withInput();
        }
    }



    public function show()
    {
        return view("pages.admin.edit-mapel");
    }

    public function rencana()
    {

        $history = PerencanaanDana::with('tahunAjaran')->get();
        Log::info('Request data received for index method', ['history' => $history]);

        return view("pages.admin.laporan-perencanaan", [
            'history' => $history,
        ]);
    }
    public function createRencana()
    {

        $barangs = StandartHarga::all();

        $tahuns = tahun_ajaran::all();
        Log::info('Request data received for index method', ['inventaris' => $barangs]);

        return view("pages.admin.add-perencanaanDana", [
            'barangs' => $barangs,
            'tahuns' => $tahuns,
        ]);
    }
    public function storeRencana(Request $request)
    {


        try {
            // Validasi data
            $validated = $request->validate([
                'tahun' => 'required|exists:tahun_ajarans,id',
                'kode_barang' => 'required|exists:standart_hargas,id',
                'qty' => 'required|integer',
            ]);

            // Log data yang telah divalidasi
            Log::info('Validated data: ', $request->all());

            $id_barang = $validated['kode_barang'];

            // Ambil data barang berdasarkan id
            $barang = StandartHarga::where('id', $id_barang)->firstOrFail();

            // Ambil harga satuan
            $harga = $barang->harga_satuan;

            // Hitung total biaya
            $totalbiaya = $validated['qty'] * $harga;

            // Buat laporan keuangan baru
            $rencana =  PerencanaanDana::create([
                'id_barang' => $validated['kode_barang'],
                'id_tahun' => $validated['tahun'],
                'qty' => $validated['qty'],
                'total_biaya' => $totalbiaya,
            ]);

            // Log keberhasilan
            Log::info('Laporan Perencanaan berhasil ditambahkan: ', $rencana->toArray());

            return redirect(route('index.rencana'))->with('success', 'Laporan Perencanaan berhasil ditambahkan!!');
        } catch (Exception $e) {
            // Log kesalahan
            Log::error('Gagal menambahkan Laporan Perencanaan: ', ['error' => $e->getMessage()]);

            // Tampilkan pesan kesalahan ke pengguna
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan laporan perencanaan. Silakan coba lagi.');
        }
    }
    public function showRencana($id)
    {
        // Ambil data PerencanaanDana berdasarkan id yang diberikan
        $dana = PerencanaanDana::with('tahunAjaran')->findOrFail($id);

        // Ambil data created_at dari PerencanaanDana dan format menjadi Y-m-d
        $createdAt = Carbon::parse($dana->created_at)->format('Y-m-d');

        // Log tanggal created_at yang diformat
        Log::info('Tanggal pembuatan PerencanaanDana:', ['created_at' => $createdAt]);

        // Lakukan query untuk mendapatkan semua PerencanaanDana yang dibuat pada tanggal yang sama
        $view = PerencanaanDana::whereDate('created_at', $createdAt)->get();

        // Kirim data ke view
        return view('pages.admin.show-perencanaan-dana', compact('dana', 'createdAt', 'view', 'id'));
    }

    public function indexPenggunaan()
    {
        $search = request()->input('search'); // Ambil parameter pencarian dari input form

        // Ambil data harga
        $harga = StandartHarga::all();

        // Ambil data aset dengan filter jika ada input pencarian
        $asetQuery = Inventaris_barang::with('barang');

        if ($search) {
            $asetQuery->where(function ($query) use ($search) {
                // Pencarian pada kolom di tabel Inventaris_barang
                $query->where('dana_pembelian', 'like', '%' . $search . '%')
                    ->orWhere('jumlah', 'like', '%' . $search . '%')
                    ->orWhere('tgl_pembelian', 'like', '%' . $search . '%')
                    ->orWhereHas('barang', function ($query) use ($search) {
                        // Pencarian pada kolom di tabel relasi barang
                        $query->where('nama_barang', 'like', '%' . $search . '%')
                            ->orWhere('kode', 'like', '%' . $search . '%')
                            ->orWhere('harga_satuan', 'like', '%' . $search . '%');
                    });
            });
        }

        $aset = $asetQuery->get();

        return view('pages.admin.penggunaan-dana', compact('harga', 'aset'));
    }

    public function viewPenggunaan(Request $request)
    {


        $idTahunAjar = $request->input('id_tahun_ajar');


        $tahunajarans = tahun_ajaran::all();

        if ($idTahunAjar) {
            $tahun = tahun_ajaran::findorfail($idTahunAjar);
            $tahunAjaranString = $tahun->tahun_ajaran;

            Log::info('Tahun:', ['tahun_ajaran' => $tahunAjaranString]);

            $tahunParts = explode('/', $tahunAjaranString);
            $tahunAwal = $tahunParts[0];
            $tahunAkhir = $tahunParts[1];
            $penggunaan = Inventaris_barang::whereYear('tgl_pembelian', $tahunAwal)
                ->orWhereYear('tgl_pembelian', $tahunAkhir)
                ->with('barang')
                ->get();

            //pemasukan per tahun ajaran
            $totalpembelian = $penggunaan->sum('total_biaya');
            Log::info('Data Penggunaan:', ['penggunaan' => $penggunaan->toArray()]);

            $mutasi = Laporan_keuangan::where('jenis_transaksi', 'uang_masuk')
                ->where('dana', 'Dana Bos')
                ->where(function ($query) use ($tahunAwal, $tahunAkhir) {
                    $query->whereYear('tanggal', $tahunAwal)
                        ->orWhereYear('tanggal', $tahunAkhir);
                })
                ->get();


            //pemasukan per tahun ajaran
            $totalpemasukan = $mutasi->sum('jumlah');


            $hasil = ($totalpemasukan ?? 0) - ($totalpembelian ?? 0);

            // Set nilai null jika totalpemasukan dan totalpembelian kosong
            $totalpembelian = $totalpembelian ?: null;
            $totalpemasukan = $totalpemasukan ?: null;
            $hasil = ($totalpemasukan !== null && $totalpembelian !== null) ? $hasil : null;
        } else {
            $tahun = null;
            $penggunaan = Inventaris_barang::all();
            $totalpembelian = null;
            $totalpemasukan = null;
            $hasil = null;
        }

        return view('pages.admin.view-penggunaan-dana', compact('tahunajarans', 'penggunaan', 'totalpembelian', 'totalpemasukan', 'hasil','idTahunAjar'));
    }
}
