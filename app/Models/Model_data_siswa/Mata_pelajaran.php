<?php

namespace App\Models\Model_data_siswa;

use App\Models\Model_raport\Raport_siswa;
use App\Models\TPCP;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mata_pelajaran extends Model
{
    use HasFactory;
    
    /**
     * Nama tabel yang terkait dengan model ini.
     *
     * @var string
     */
    protected $table = 'mata_pelajarans';
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [

        'nama_pelajaran',
        'keterangan',


    ];
    /**
     * Relasi ke model Jadwal Pelajaran.
     */
    public function jadwal()
    {
        return $this->hasMany(Jadwal_pelajaran::class, 'id_mapel');
    }

    /**
     * Relasi ke model raport siswa.
     */
    public function raport_siswa()
    {
        return $this->hasMany(Raport_siswa::class, 'id_mapel','id');
    }
    /**
     * Relasi ke model TP/CP.
     */
    public function tpcps()
    {
        return $this->hasMany(TPCP::class, 'id_mapel');
    }
}
