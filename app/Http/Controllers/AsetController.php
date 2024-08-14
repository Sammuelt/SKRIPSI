<?php

namespace App\Http\Controllers;

use App\Models\Model_laporan\Inventaris_barang;
use App\Models\SaldoKeuangan;
use App\Models\StandartHarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AsetController extends Controller
{
    public function index()
    {
        $inventaris = Inventaris_barang::with('barang')->get();
        Log::info('Request data received for index method', ['inventaris' => $inventaris]);
        return view('pages.admin.inventaris', [
            'inventaris' => $inventaris,
        ]);
    }
    public function indekSatuanHarga(Request $request)
    {
        $search = $request->input('search');
    
        // Cek apakah ada input pencarian
        if ($search) {
            $harga = StandartHarga::where('nama_barang', 'LIKE', "%{$search}%")
            ->where('kode', 'LIKE', "%{$search}%")
            ->where('harga_satuan', 'LIKE', "%{$search}%")
            ->get();
        } else {
            $harga = StandartHarga::all();
        }
    
        return view('pages.admin.satuan-harga', [
            'harga' => $harga,
        ]);
    }
    public function createharga(Request $request)
    {
        Log::info('Request data received for createharga:', $request->all());


        $validatedData = $request->validate([
            'kode_barang' => 'required|string|max:255',
            'nama_barang' =>'required|string|max:255',
            'harga_satuan' => 'required|numeric',
        ]);

        Log::info('Validated data:', $validatedData);




        $jumlahBeli = $request->input('jumlah_beli') ?? 0;

        Log::info('Jumlah beli:', ['jumlah_beli' => $jumlahBeli]);


        $totalHarga = $request->input('harga_satuan') * $jumlahBeli;


        Log::info('Total harga calculated:', ['total_harga' => $totalHarga]);


        $standartHarga = StandartHarga::create([
            'kode' => $request->input('kode_barang'),
            'nama_barang' => $request->input('nama_barang'),
            'harga_satuan' => $request->input('harga_satuan'),
            'jumlah_beli' => $jumlahBeli,
            'total_harga' => $totalHarga,
        ]);

        Log::info('StandartHarga record created:', $standartHarga->toArray());

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }


    public function create()
    {
        $barangs = StandartHarga::all();

        return view('pages.admin.add-aset', [
            'barangs' => $barangs,
        ]);
    }

    public function store(Request $request)
    {
        // Validasi input dari request
        $validated = $request->validate([
            'tgl_pembelian' => 'required|date',
            'dana_pembelian' => 'required|string|in:' . implode(',', Inventaris_barang::$enumDana),
            'kode_barang' => 'required|exists:standart_hargas,id',
            'jumlah' => 'required|integer|max:11',
            'kondisi' => 'required|string|in:' . implode(',', Inventaris_barang::$enumKondisi),
            'lokasi' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
        ]);
        Log::info('Validated data: ', $request->all());

          // Ambil StandartHarga berdasarkan kode_barang
          $harga = StandartHarga::find($validated['kode_barang']);

          if ($harga) {
              // Ambil harga satuan dan hitung total harga
              $hargaSatuan = $harga->harga_satuan;
              $jumlahnow = $harga->jumlah_beli;
              $totalHarga = $harga->total_harga;
              $totalHargaitem = $hargaSatuan * $validated['jumlah'];
  
              // Update jumlah_beli dan total_harga di StandartHarga
              $jumlahupdate = $jumlahnow + $validated['jumlah'];
              $harga->jumlah_beli = $jumlahupdate;
  
              $totalHargaupdate = $totalHarga + $totalHargaitem;
              $harga->total_harga = $totalHargaupdate;
              $harga->save();
  
              Log::info('Updated StandartHarga:', $harga->toArray());
          } else {
              Log::warning('StandartHarga not found for kode_barang:', ['kode_barang' => $validated['kode_barang']]);
          }
        // Buat atau update Inventaris_barang
        $aset = Inventaris_barang::create([
            'tgl_pembelian' => $validated['tgl_pembelian'],
            'dana_pembelian' => $validated['dana_pembelian'],
            'id_barang' => $validated['kode_barang'],
            'jumlah' => $validated['jumlah'],
            'kondisi' => $validated['kondisi'],
            'lokasi' => $validated['lokasi'],
            'total_biaya' => $totalHargaitem?? null, 
            'keterangan' => $validated['keterangan'],
        ]);

        // Log data aset yang baru dibuat
        Log::info('Aset created:', $aset->toArray());

      

        //      // Ambil saldo keuangan
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
       if ($validated['dana_pembelian'] == 'Dana Bos') {
           $saldo->Saldo_bos -= $totalHargaitem;
       } else {
           $saldo->Saldo_lain -= $totalHargaitem;
       }
   
       $saldo->Saldo_semua -= $totalHargaitem;

       $saldo->save();
           
        

        // Redirect dengan pesan sukses
        return redirect(route('index.inventaris'))->with('success', 'Aset berhasil ditambahkan!!');
    }



    public function show_aset()
    {
        return view("pages.admin.edit-aset");
    }
    public function edit($id)
    {
        $aset = Inventaris_barang::findOrFail($id);
        $barangs = StandartHarga::all();

        return view('pages.admin.edit-aset', compact('aset', 'barangs'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data dari request
        $validated = $request->validate([
            'tgl_pembelian' => 'required|date',
            'dana_pembelian' => 'required|string|in:' . implode(',', Inventaris_barang::$enumDana),
            'kode_barang' => 'required|exists:standart_hargas,id',
            'jumlah' => 'required|integer|max:11',
            'kondisi' => 'required|string|in:' . implode(',', Inventaris_barang::$enumKondisi),
            'lokasi' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
        ]);

        // Log data yang tervalidasi
        Log::info('Validated data:', $validated);

        // Temukan aset berdasarkan ID
        $aset = Inventaris_barang::findOrFail($id);
        $originalData = $aset->getOriginal(); // Data sebelum diupdate

        // Cek apakah kode_barang berubah
        $isKodeBarangChanged = $originalData['id_barang'] !== $validated['kode_barang'];

        if ($isKodeBarangChanged) {
            // Update StandartHarga untuk kode_barang lama
            $oldBarang = StandartHarga::find($originalData['id_barang']);
            if ($oldBarang) {
                $hargaSatuanOld = $oldBarang->harga_satuan;
                $totalHargaOld = $oldBarang->total_harga;
                $jumlahOld = $oldBarang->jumlah_beli;

                $totalHargaOldUpdate = $totalHargaOld - ($hargaSatuanOld * $originalData['jumlah']);
                $jumlahOldUpdate = $jumlahOld - $originalData['jumlah'];

                $oldBarang->update([
                    'jumlah_beli' => $jumlahOldUpdate,
                    'total_harga' => $totalHargaOldUpdate,
                ]);

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
                if ($validated['dana_pembelian'] == 'Dana Bos') {
                    $saldo->Saldo_bos += $totalHargaOldUpdate;
                } else {
                    $saldo->Saldo_lain += $totalHargaOldUpdate;
                }
            
                $saldo->Saldo_semua += $totalHargaOldUpdate;
         
                $saldo->save();

                Log::info('Updated StandartHarga for old kode_barang:', $oldBarang->toArray());
            }

            // Update StandartHarga untuk kode_barang baru
            $newBarang = StandartHarga::find($validated['kode_barang']);
            if ($newBarang) {
                $hargaSatuanNew = $newBarang->harga_satuan;
                $totalHargaNew = $newBarang->total_harga;
                $jumlahNew = $newBarang->jumlah_beli;

                $totalHargaNewUpdate = $totalHargaNew + ($hargaSatuanNew * $validated['jumlah']);
                $jumlahNewUpdate = $jumlahNew + $validated['jumlah'];

                $newBarang->update([
                    'jumlah_beli' => $jumlahNewUpdate,
                    'total_harga' => $totalHargaNewUpdate,
                ]);

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
                if ($validated['dana_pembelian'] == 'Dana Bos') {
                    $saldo->Saldo_bos -= $totalHargaNewUpdate;
                } else {
                    $saldo->Saldo_lain -= $totalHargaNewUpdate;
                }
            
                $saldo->Saldo_semua -= $totalHargaNewUpdate;
         
                $saldo->save();

                Log::info('Updated StandartHarga for new kode_barang:', $newBarang->toArray());
            } else {
                Log::warning('StandartHarga not found for new kode_barang:', ['kode_barang' => $validated['kode_barang']]);
            }
        } else {
            // Jika kode_barang tidak berubah, hanya update jumlah dan total harga
            $harga = StandartHarga::find($validated['kode_barang']);
            if ($harga) {
                $hargaSatuan = $harga->harga_satuan;
                $totalHargaOld = $harga->total_harga;
                $jumlahOld = $harga->jumlah_beli;

                $totalHargaUpdate = $totalHargaOld - ($hargaSatuan * $originalData['jumlah']) + ($hargaSatuan * $validated['jumlah']);
                $jumlahUpdate = $jumlahOld - $originalData['jumlah'] + $validated['jumlah'];

                $harga->update([
                    'jumlah_beli' => $jumlahUpdate,
                    'total_harga' => $totalHargaUpdate,
                ]);

                Log::info('Updated StandartHarga for unchanged kode_barang:', $harga->toArray());
            } else {
                Log::warning('StandartHarga not found for kode_barang:', ['kode_barang' => $validated['kode_barang']]);
            }
        }
        

        
        // Update data aset
        $aset->update($validated);

        // Log perubahan data
        Log::info('Aset updated', [
            'original' => $originalData,
            'changed' => $aset->getChanges(),
            'updated_by' => auth()->user()->id,
        ]);

        return redirect()->route('index.inventaris')->with('success', 'Item updated successfully.');
    }



    public function destroy($id)
    {
        // Temukan aset berdasarkan ID
        $aset = Inventaris_barang::findOrFail($id);

        // Temukan StandartHarga terkait dengan kode_barang
        $barang = StandartHarga::find($aset->id_barang);

        if ($barang) {
            // Hitung total harga yang akan dikurangi
            $hargaSatuan = $barang->harga_satuan;
            $totalHargaDihapus = $hargaSatuan * $aset->jumlah;
            $jumlahBeliDihapus = $barang->jumlah_beli - $aset->jumlah;
            $totalHargaBaru = $barang->total_harga - $totalHargaDihapus;

            // Perbarui StandartHarga
            $barang->update([
                'jumlah_beli' => $jumlahBeliDihapus,
                'total_harga' => $totalHargaBaru,
            ]);

            Log::info('Updated StandartHarga after deletion:', $barang->toArray());
        } else {
            Log::warning('StandartHarga not found for kode_barang:', ['kode_barang' => $aset->id_barang]);
        }

        // Hapus aset
        $aset->delete();

        // Log penghapusan
        Log::info('Aset deleted:', ['id' => $id]);

        return redirect(route('index.inventaris'))->with('success', 'Aset berhasil dihapus!!');
    }
}
