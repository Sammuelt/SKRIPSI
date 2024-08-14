<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Model_data_siswa\Kelas;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GuruController extends Controller
{
    // GURU & STAFF

    public function index(Request $request)
    {
        $keyword = $request->input('search');

        if ($keyword) {
            $tbl_guru = Guru::query()
                ->where('nama', 'like', "%{$keyword}%")
                ->orWhere('nomor_induk_pegawai', 'like', "%{$keyword}%")
                ->orWhere('jabatan', 'like', "%{$keyword}%")
                ->orWhere('status', 'like', "%{$keyword}%")
                ->get();
        } else {
            $tbl_guru = Guru::all();
        }

        return view("pages.admin.guru", [
            'guru' => $tbl_guru
        ]);
    }

    public function create()
    {
        return view('pages.admin.add-guru');
    }

    public function store(Request $request)
    {
        Log::info('Request received:', $request->all());

        $validated = $request->validate([
            'nomor_induk_pegawai' => 'required|numeric|unique:tbl_guru,nomor_induk_pegawai',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|in:' . implode(',', Guru::$enumJenisKelamin),
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|max:255',
            'pendidikan' => 'required|string|max:255',
            'golongan' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'phone' => 'required|string|max:13',
            'email' => 'required|email|max:255',
        ]);

        // Log the validated data
        Log::info('Validated data:', $validated);

        try {
            $guru = Guru::create([
                'nomor_induk_pegawai' => $validated['nomor_induk_pegawai'],
                'nama' => $validated['nama'],
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'tempat_lahir' => $validated['tempat_lahir'],
                'tanggal_lahir' => $validated['tanggal_lahir'],
                'alamat' => $validated['alamat'],
                'pendidikan' => $validated['pendidikan'],
                'golongan' => $validated['golongan'],
                'status' => $validated['status'],
                'jabatan' => $validated['jabatan'],
                'no_hp' => $validated['phone'],
                'email' => $validated['email'],
            ]);

            Log::info('Guru created:', $guru->toArray());

            return redirect(route('index.guru'))->with('success', 'Data guru berhasil ditambahkan!!');
        } catch (\Exception $e) {
            Log::error('Failed to create guru:', ['error' => $e->getMessage()]);

            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan data guru. Silakan coba lagi.');
        }
    }


    public function show($id)
    {
        $guru = Guru::findOrFail($id);
        return view('pages.admin.show-guru', compact('guru'));
    }
    public function edit($id)
    {
        $guru = Guru::findOrFail($id);
        return view('pages.admin.edit-guru', compact('guru'));
    }
    public function update(Request $request, $id)
    {
        try {
            // Validasi data yang diterima dari form
            $request->validate([
                'nomor_induk_pegawai' => 'required|string',
                'email' => 'required|email',
                'no_hp' => 'required|string',
                'nama' => 'required|string',
                'jenis_kelamin' => 'required|string',
                'tempat_lahir' => 'required|string',
                'tanggal_lahir' => 'required|date',
                'status' => 'required|string',
                'golongan' => 'required|string',
                'jabatan' => 'required|string',
                'pendidikan' => 'required|string',
                'alamat' => 'required|string',
            ]);

            // Temukan data guru berdasarkan ID
            $guru = Guru::findOrFail($id);

            // Catat data request yang akan diubah
            Log::info("Permintaan perubahan data Guru ID: {$id}", $request->all());

            // Catat data guru sebelum perubahan
            $oldData = $guru->toArray();

            // Ambil email lama dan email baru
            $emailLama = $oldData['email'];
            $emailBaru = $request->input('email');

            // Lakukan pembaruan data guru
            $guru->update([
                'nomor_induk_pegawai' => $request->nomor_induk_pegawai,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'nama' => $request->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'status' => $request->status,
                'golongan' => $request->golongan,
                'jabatan' => $request->jabatan,
                'pendidikan' => $request->pendidikan,
                'alamat' => $request->alamat,
            ]);

            // Update email pada model User jika email lama ada
            $user = User::where('email', $emailLama)->first();
            if ($user) {
                $user->email = $emailBaru;
                $user->save();

                Log::info('Email User diperbarui', [
                    'user_id' => $user->id,
                    'old_email' => $emailLama,
                    'new_email' => $user->email,
                ]);
            }

            // Catat data guru setelah perubahan
            $newData = $guru->toArray();
            Log::info("Data guru berhasil diperbarui. Sebelum: " . json_encode($oldData) . ", Sesudah: " . json_encode($newData));

            // Redirect ke halaman detail guru dengan pesan sukses
            return redirect()->route('show.guru', $guru->id)->with('success', 'Data guru berhasil diperbarui.');
        } catch (ModelNotFoundException $e) {
            // Tangani jika data guru tidak ditemukan
            Log::error("Guru tidak ditemukan dengan ID: {$id}. Pesan error: " . $e->getMessage());
            return back()->with('error', 'Guru tidak ditemukan.');
        } catch (ValidationException $e) {
            // Tangani jika terjadi kesalahan validasi
            Log::error("Terjadi kesalahan validasi saat memperbarui Guru ID: {$id}. Error: " . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Tangani pengecualian lain yang tidak terduga
            Log::error("Terjadi kesalahan saat memperbarui data Guru ID: {$id}. Pesan error: " . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memperbarui data guru. Silakan coba lagi.');
        }
    }


    public function delete($id)
    {
        try {
            // Temukan guru berdasarkan ID, jika tidak ada, akan memunculkan error 404
            $guru = Guru::findOrFail($id);

            // Log ID guru yang akan dihapus
            Log::info('Menghapus guru dengan ID: ' . $id);

            // Cek apakah guru ini merupakan wali kelas
            $kelas = Kelas::where('id_walikelas', $guru->id)->get();

            if ($kelas->isNotEmpty()) {
                foreach ($kelas as $kls) {
                    Log::info('Menghapus relasi kelas dengan ID kelas: ' . $kls->id . ' yang memiliki id_walikelas: ' . $guru->id);

                    $kls->id_walikelas = null;
                    $kls->save();
                }
            }


            $guru->delete();


            Log::info('Berhasil menghapus guru dengan ID: ' . $id);

            return redirect(route('index.guru'))->with('success', 'Guru berhasil dihapus!');
        } catch (\Exception $e) {
            // Log error
            Log::error('Error menghapus guru dengan ID: ' . $id . '. Pesan error: ' . $e->getMessage());

            return redirect(route('index.guru'))->with('error', 'Terjadi kesalahan saat menghapus guru. Silakan coba lagi.');
        }
    }

    public function walikelas()
    {

        $Walikelas = Kelas::with('walikelas')->get();

        $guru = Guru::all();

        return view('pages.admin.walikelas', compact('guru', 'Walikelas'));
    }
    
    public function updatewalikelas(Request $request)
{
    // Validasi request
    $validated = $request->validate([
        'id' => 'required|integer|exists:kelas,id',
        'walikelas' => 'required|integer|exists:tbl_guru,id',
    ]);

    // Cek apakah guru sudah menjadi wali kelas di kelas lain
    $existingKelas = Kelas::where('id_walikelas', $validated['walikelas'])
                          ->where('id', '<>', $validated['id'])
                          ->first();

    if ($existingKelas) {
        return redirect()->back()->with('error', 'Guru tersebut sudah menjadi wali kelas di kelas lain.');
    }

    // Temukan data yang ingin diperbarui
    $kelas = Kelas::find($validated['id']);
    if ($kelas) {
        $kelas->id_walikelas = $validated['walikelas'];
        $kelas->save();

        return redirect()->back()->with('success', 'Data wali kelas berhasil diperbarui.');
    }

    return redirect()->back()->with('error', 'Gagal memperbarui data wali kelas.');
}

}
