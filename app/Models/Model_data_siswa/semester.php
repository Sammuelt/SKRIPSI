<?php

namespace App\Models\Model_data_siswa;

use App\Models\Kalender_Sekolah;
use App\Models\Model_raport\raport_ekstrakulikuler_siswa;
use App\Models\Model_raport\Raport_Mbkm;
use App\Models\Model_raport\Raport_siswa;
use App\Models\TPCP;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class semester extends Model
{
    use HasFactory;
    /**
  * fillable
  *
  * @var array
  */
 protected $fillable = [
   
     'semester',
     

 ];

    /**
     * Relasi ke model Kehadiran.
     */
    public function kehadiran()
    {
        return $this->hasMany(Kehadiran::class, 'id_semester');
    }
    /**
     * Relasi ke model Kehadiran.
     */
    public function raport_ekstrakulikuler()
    {
        return $this->hasMany(raport_ekstrakulikuler_siswa::class, 'id_semester');
    }
      /**
     * Relasi ke model raport siswa.
     */
    public function raport_siswa()
    {
        return $this->hasMany(Raport_siswa::class, 'id_semester');
    }
    /**
     * Relasi ke model raport siswa.
     */
    public function raport_mbkm()
    {
        return $this->hasMany(Raport_Mbkm::class, 'id_semester');
    }
    /**
     * Relasi ke model raport siswa.
     */
    public function kalender()
    {
        return $this->hasMany(Kalender_Sekolah::class, 'id_semester');
    }
    /**
     * Relasi ke model TP/CP.
     */
    public function TPCP()
    {
        return $this->hasMany(TPCP::class, 'id_semester');
    }
}
