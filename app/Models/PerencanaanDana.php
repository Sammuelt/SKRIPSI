<?php

namespace App\Models;

use App\Models\Model_data_siswa\tahun_ajaran;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerencanaanDana extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_barang',
        'id_tahun',
        'qty',
        'total_biaya',
    ];

    public function barang()
    {
        return $this->belongsTo(StandartHarga::class, 'id_barang');
    }
    public function tahunAjaran()
    {
        return $this->belongsTo(tahun_ajaran::class, 'id_tahun');
    }
}
