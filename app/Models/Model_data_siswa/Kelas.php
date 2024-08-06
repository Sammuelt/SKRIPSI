<?php

namespace App\Models\Model_data_siswa;

use App\Models\Guru;
use App\Models\Model_raport\raport_ekstrakulikuler_siswa;
use App\Models\Model_raport\Raport_Mbkm;
use App\Models\Model_raport\Raport_siswa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    /**
  * fillable
  *
  * @var array
  */
 protected $fillable = [
   
     'nama_kelas',
     'id_walikelas'
 ];
 /**
     * Relasi ke model Jadwal Pelajaran.
     */
    public function jadwal()
    {
        return $this->hasMany(Jadwal_pelajaran::class, 'id_kelas');
    }
      /**
     * Relasi ke model raport Ekstrakulikuler.
     */
    public function raport_ekstrakulikuler()
    {
        return $this->hasMany(raport_ekstrakulikuler_siswa::class, 'id_kelas');
    }
      /**
     * Relasi ke model raport siswa.
     */
    public function raport_siswa()
    {
        return $this->hasMany(Raport_siswa::class, 'id_kelas');
    }
    /**
     * Relasi ke model raport siswa.
     */
    public function raport_mbkm()
    {
        return $this->hasMany(Raport_Mbkm::class, 'id_kelas');
    }
    /**
     * Relasi ke model raport siswa.
     */
    public function kehadiran()
    {
        return $this->hasMany(Kehadiran::class, 'id_kelas');
    }
    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id_kelas_now');
    }
    /**
     * Relasi dari model raport siswa.
     */
    public function walikelas()
    {
        return $this->belongsTo(Guru::class, 'id_walikelas');
    }
}
