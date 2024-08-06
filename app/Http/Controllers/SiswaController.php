<?php

namespace App\Http\Controllers;

use App\Models\Model_data_siswa\Kelas;
use App\Models\Model_data_siswa\Siswa;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class SiswaController extends Controller
{
    public function index()
    {
        $kelas = Kelas::with('walikelas')->get();
        return view('pages.admin.siswa', compact('kelas'));
    }

    public function index_kelas()
    {
        $siswa = Siswa::all();
        return view('pages.admin.kelas', compact('siswa'));
    }

    public function indexByKelas($id_kelas)
    {
        try {
            $kelas = Kelas::findOrFail($id_kelas);
            $siswa = Siswa::where('id_kelas_now', $id_kelas)->get();
            return view('pages.admin.kelas', compact('kelas', 'siswa'));
        } catch (ModelNotFoundException $e) {
            Log::error("Kelas tidak ditemukan dengan ID: {$id_kelas}. Pesan error: " . $e->getMessage());
            return back()->with('error', 'Kelas tidak ditemukan.');
        }
    }

    public function create()
    {
        $kelas = Kelas::all();
        return view('pages.admin.add-siswa', compact('kelas'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nisn' => 'required|numeric|unique:tbl_data_siswa,nisn',
                'id_kelas_now' => 'required|integer',
                'nama_lengkap' => 'required|string|max:255',
                'jenis_kelamin' => 'required|string|in:' . implode(',', Siswa::$enumJenisKelamin),
                'tempat_lahir' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'alamat' => 'required|string|max:255',
                'nama_orang_tua' => 'required|string|max:255',
                'no_hp_ortu' => 'required|string|max:13',
            ]);

            // Log request data
            Log::info('Request data to store siswa:', $validated);

            // Buat data siswa baru
            $siswa = Siswa::create($validated);

            // Log success message
            Log::info('Data siswa berhasil ditambahkan:', $siswa->toArray());

            return redirect(route('index.siswa'))->with('success', 'Data siswa berhasil ditambahkan!');
        } catch (ValidationException $e) {
            Log::error('Terjadi kesalahan validasi saat menambahkan data siswa. Error: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Gagal menambahkan data siswa: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Gagal menambahkan data siswa. Silakan coba lagi.');
        }
    }

    public function show($id)
    {
        try {
            $siswa = Siswa::findOrFail($id);
            return view('pages.admin.detail-siswa', compact('siswa'));
        } catch (ModelNotFoundException $e) {
            Log::error("Siswa tidak ditemukan dengan ID: {$id}. Pesan error: " . $e->getMessage());
            return back()->with('error', 'Siswa tidak ditemukan.');
        }
    }

    public function edit($id)
    {
        try {
            $siswa = Siswa::findOrFail($id);
            $kelas = Kelas::all();
            return view('pages.admin.edit-siswa', compact('siswa', 'kelas'));
        } catch (ModelNotFoundException $e) {
            Log::error("Siswa tidak ditemukan dengan ID: {$id}. Pesan error: " . $e->getMessage());
            return back()->with('error', 'Siswa tidak ditemukan.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'nisn' => 'required|string',
                'id_kelas_now' => 'required|integer',
                'nama_lengkap' => 'required|string|max:255',
                'jenis_kelamin' => 'required|string|in:' . implode(',', Siswa::$enumJenisKelamin),
                'tempat_lahir' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'alamat' => 'required|string|max:255',
                'nama_orang_tua' => 'required|string|max:255',
                'no_hp_ortu' => 'required|string|max:13',
            ]);

            // Temukan data siswa berdasarkan ID
            $siswa = Siswa::findOrFail($id);

            // Catat data request yang akan diubah
            Log::info("Permintaan perubahan data siswa ID: {$id}", $validated);

            // Lakukan pembaruan data siswa
            $siswa->update($validated);

            // Log success message
            Log::info("Data siswa berhasil diperbarui. ID: {$id}");

            // Redirect ke halaman detail siswa dengan pesan sukses
            return redirect()->route('show.siswa', $siswa->id)->with('success', 'Data siswa berhasil diperbarui.');
        } catch (ValidationException $e) {
            Log::error("Terjadi kesalahan validasi saat memperbarui data siswa ID: {$id}. Error: " . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        } catch (ModelNotFoundException $e) {
            Log::error("Siswa tidak ditemukan dengan ID: {$id}. Pesan error: " . $e->getMessage());
            return back()->with('error', 'Siswa tidak ditemukan.');
        } catch (\Exception $e) {
            Log::error("Terjadi kesalahan saat memperbarui data siswa ID: {$id}. Pesan error: " . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memperbarui data siswa. Silakan coba lagi.');
        }
    }

    public function delete($id)
    {
        try {

            $siswa = Siswa::findOrFail($id);


            $siswa->delete();

            // Log pesan sukses
            Log::info("Data siswa ID: {$id} berhasil dihapus.");

            // Redirect ke halaman sebelumnya dengan pesan sukses
            return redirect()->back()->with('success', 'Data siswa berhasil dihapus.');
        } catch (ModelNotFoundException $e) {
            // Tangani jika siswa tidak ditemukan
            Log::error("Siswa tidak ditemukan dengan ID: {$id}. Pesan error: " . $e->getMessage());
            return back()->with('error', 'Siswa tidak ditemukan.');
        } catch (\Exception $e) {
            // Tangani error umum
            Log::error("Gagal menghapus data siswa ID: {$id}. Pesan error: " . $e->getMessage());
            return back()->with('error', 'Gagal menghapus data siswa. Silakan coba lagi.');
        }
    }

}
