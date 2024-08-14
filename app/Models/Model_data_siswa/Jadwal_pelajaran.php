<?php

namespace App\Models\Model_data_siswa;

use App\Models\Guru;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal_pelajaran extends Model
{
    use HasFactory;
    /**
  * fillable
  *
  * @var array
  */
 protected $fillable = [
     'id_mapel',
     'id_kelas',
     'id_guru',
     'hari',
     'jam_mulai',
     'jam_selesai',

 ];
 public static $enumHari = ['senin', 'selasa','rabu','kamis','jumat','sabtu'];

 // Opsi lain: validasi di sini
 public function setHariAttribute($value)
 {
     if (!in_array($value, self::$enumHari)) {
         throw new \InvalidArgumentException("hari tidak valid");
     }

     $this->attributes['hari'] = $value;
 }
 
    /**
     * Relasi ke model mapel.
     */
    public function mapel()
    {
        return $this->belongsTo(Mata_pelajaran::class, 'id_mapel');
    }

    /**
     * Relasi ke model kelas.
     */
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    /**
     * Relasi ke model guru.
     */
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }
}
