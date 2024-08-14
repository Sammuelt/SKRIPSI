<?php

namespace App\Models;

use App\Models\Model_laporan\Inventaris_barang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StandartHarga extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'nama_barang',
        'harga_satuan',
        'jumlah_beli',
        'total_harga',
     ];
     public function inventaris()
     {
         return $this->belongsTo(Inventaris_barang::class, 'id_barang');
     }
     public function perencanaan()
     {
         return $this->belongsTo(PerencanaanDana::class, 'id_barang');
     }
}
