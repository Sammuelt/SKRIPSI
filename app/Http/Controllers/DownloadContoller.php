<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Model_data_siswa\Extrakulikuler;
use App\Models\Model_data_siswa\Kehadiran;
use App\Models\Model_data_siswa\Kelas;
use App\Models\Model_data_siswa\Mata_pelajaran;
use App\Models\Model_data_siswa\semester;
use App\Models\Model_data_siswa\Siswa;
use App\Models\Model_data_siswa\tahun_ajaran;
use App\Models\Model_laporan\Inventaris_barang;
use App\Models\Model_laporan\Laporan_keuangan;
use App\Models\Model_raport\raport_ekstrakulikuler_siswa;
use App\Models\Model_raport\Raport_Mbkm;
use App\Models\Model_raport\Raport_siswa;
use App\Models\PerencanaanDana;
use App\Models\Prestasi;
use App\Models\StandartHarga;
use App\Models\TPCP;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DownloadContoller extends Controller
{
    public function downloadGuru()
    {
        $guru = Guru::all();

        return view("pages.print-out.print-guru", [
            'guru' => $guru
        ]);
    }
    public function downloadDetailGuru($id)
    {
        $guru = Guru::findOrFail($id);

        return view("pages.print-out.print-detail-guru", compact('guru'));
    }
    public function downloadSiswa($id)
    {
        // Ambil data siswa berdasarkan ID kelas
        $siswa = Siswa::where('id_kelas_now', $id)->get();

        // Ambil data kelas beserta walikelasnya
        $kelas = Kelas::with('walikelas')->findOrFail($id);

        // Kirim data ke view
        return view('pages.print-out.print-siswa', compact('siswa', 'kelas'));
    }
    public function downloadDetailiswa($id)
    {
        // Ambil data siswa berdasarkan ID kelas
        $siswa = Siswa::findOrFail($id);
        // Kirim data ke view
        return view('pages.print-out.print-detail-siswa', compact('siswa'));
    }
    public function downloadMapel()
    {
        // Ambil data siswa berdasarkan ID kelas
        $mapel = Mata_pelajaran::all();
        // Kirim data ke view
        return view('pages.print-out.print-mapel', compact('mapel'));
    }
    public function downloadEkskul()
    {
        // Ambil data siswa berdasarkan ID kelas
        $ekskul = Extrakulikuler::all();
        // Kirim data ke view
        return view('pages.print-out.print-ekskul', compact('ekskul'));
    }
    public function downloadAset()
    {
        // Ambil data siswa berdasarkan ID kelas
        $inventaris = Inventaris_barang::all();
        // Kirim data ke view
        return view('pages.print-out.print-aset', compact('inventaris'));
    }
    public function downloadkeuangan()
    {
        // Ambil data siswa berdasarkan ID kelas
        $keuangan = Laporan_keuangan::all();
        // Kirim data ke view
        return view('pages.print-out.print-keuangan', compact('keuangan'));
    }
    public function downloadPerencanaan($id)
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
        return view('pages.print-out.print-perencanaan', compact('dana', 'createdAt', 'view'));
    }
    public function downloadAkadmik($id)
    {
        $data = Raport_siswa::findOrFail($id);



        // Ambil id_siswa dari data yang sudah diambil
        $siswa = $data->id_siswa;
        $kelas = $data->id_kelas;
        $semester = $data->id_semester;
        $tahun = $data->id_tahun_ajar;

        // Log informasi pengambilan data
        Log::info('Mengambil data Raport_siswa untuk siswa:', [
            'id_siswa' => $siswa,
            'id_kelas' => $kelas,
            'id_semester' => $semester,
            'id_tahun_ajar' => $tahun,
            'id_raport' => $id
        ]);


        $raports = Raport_siswa::where('id_siswa', $siswa)
            ->where('id_kelas', $kelas)
            ->where('id_semester', $semester)
            ->where('id_tahun_ajar', $tahun)
            ->with(['semester', 'tahunAjaran', 'kelas', 'siswa', 'mapel'])
            ->get();

        // Log hasil pengambilan data
        Log::info('Data Raport_siswa yang ditemukan:', [
            'jumlah' => $raports->count(),
            'data' => $raports
        ]);

        $ekskul = raport_ekstrakulikuler_siswa::where('id_siswa', $siswa)
            ->where('id_kelas', $kelas)
            ->where('id_semester', $semester)
            ->where('id_tahun_ajar', $tahun)
            ->with(['semester', 'tahunAjaran', 'kelas', 'siswa', 'mapel'])
            ->get();

        $datahadir = Kehadiran::where('id_siswa', $siswa)
            ->where('id_kelas', $kelas)
            ->where('id_semester', $semester)
            ->where('id_tahun_ajar', $tahun)
            ->with(['semester', 'tahunAjaran', 'kelas', 'siswa', 'mapel'])
            ->get();
        // Kirim data ke view
        return view('pages.print-out.print-raport-akademik', compact('raports', 'data', 'ekskul', 'datahadir', 'semester'));
    }
    public function downloadMbkm($id)
    {
        $data = Raport_Mbkm::findOrFail($id);
        // Ambil id_siswa dari data yang sudah diambil
        $siswa = $data->id_siswa;
        $kelas = $data->id_kelas;
        $semester = $data->id_semester;
        $tahun = $data->id_tahun_ajar;

        Log::info('Mengambil data Raport_siswa untuk siswa:', [
            'id_siswa' => $siswa,
            'id_kelas' => $kelas,
            'id_semester' => $semester,
            'id_tahun_ajar' => $tahun,
            'id_raport' => $id
        ]);


        $raports = Raport_Mbkm::where('id_siswa', $siswa)
            ->where('id_kelas', $kelas)
            ->where('id_semester', $semester)
            ->where('id_tahun_ajar', $tahun)
            ->with(['semester', 'tahunAjaran', 'kelas', 'siswa', 'nilai_Mbkm', 'capaian_mbkm', 'project_Mbkm'])
            ->get();

        // Log hasil pengambilan data
        Log::info('Data Raport_siswa yang ditemukan:', [
            'jumlah' => $raports->count(),
            'data' => $raports
        ]);
        $uniqueProjectTitles = $raports->pluck('project_Mbkm.judul')->unique();
        $uniqueProjectSubTitles = $raports->pluck('project_Mbkm.description')->unique();
        $uniqueProjectCP = $raports->pluck('project_Mbkm.capaian_proses')->unique();
        return view('pages.print-out.print-raport-mbkm', compact('data', 'raports', 'uniqueProjectTitles', 'uniqueProjectSubTitles', 'uniqueProjectCP'));
    }

    public function downloadTpcp($idKelas, $idSemester)
    {

        $kelas = Kelas::find($idKelas);

        // Mengambil data semester berdasarkan idSemester
        $semester = semester::find($idSemester);
        $query = TPCP::query()->with(['mapel']);

        // Filter berdasarkan id_kelas jika ada
        if ($idKelas) {
            $query->where('id_kelas', $idKelas);
        }

        // Filter berdasarkan id_semester jika ada
        if ($idSemester) {
            $query->where('id_semester', $idSemester);
        }

        // Ambil data CP yang sesuai dengan filter
        $filteredCpData = $query->get();
        return view('pages.print-out.print-tpcp', compact('filteredCpData','kelas','semester'));
    }
    public function downloadkelas(){

        $Walikelas = Kelas::with('walikelas')->get();

        $guru = Guru::all();

        return view('pages.print-out.print-walikelas', compact('guru', 'Walikelas'));
    }
    public function downloadprestasi(){

        $prestasi = Prestasi::all();

        $siswa = Siswa::all();

        return view('pages.print-out.print-prestasi', compact('prestasi', 'siswa'));
    }
    public function downloadharga(){

        $harga = StandartHarga::all();

        return view('pages.print-out.print-harga-satuan', compact('harga'));
    }
    public function downloadpenggunaandana($id){
        if ($id) {
            $tahun = tahun_ajaran::findorfail($id);
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

        return view('pages.print-out.print-laporan-penggunaan-dana', compact('penggunaan', 'totalpembelian', 'totalpemasukan', 'hasil'));
    }
        
}
