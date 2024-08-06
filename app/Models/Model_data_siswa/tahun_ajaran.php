<?php

namespace App\Models\Model_data_siswa;

use App\Models\Kalender_Sekolah;
use App\Models\Model_raport\raport_ekstrakulikuler_siswa;
use App\Models\Model_raport\Raport_Mbkm;
use App\Models\Model_raport\Raport_siswa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tahun_ajaran extends Model
{
    use HasFactory;
 /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tahun_ajarans';


    /**
  * fillable
  *
  * @var array
  */
 protected $fillable = [
   
     'tahun_ajaran',
     

 ];
   /**
     * Relasi ke model Kehadiran.
     */
    public function kehadiran()
    {
        return $this->hasMany(Kehadiran::class, 'id_tahun_ajar');
    }

    /**
     * Relasi ke model Kehadiran.
     */
    public function raport_ekstrakulikuler()
    {
        return $this->hasMany(raport_ekstrakulikuler_siswa::class, 'id_tahun_ajar');
    }

      /**
     * Relasi ke model raport siswa.
     */
    public function raport_siswa()
    {
        return $this->hasMany(Raport_siswa::class, 'id_tahun_ajar');
    }

      /**
     * Relasi ke model raport siswa.
     */
    public function raport_mbkm()
    {
        return $this->hasMany(Raport_Mbkm::class, 'id_tahun_ajar');
    }
      /**
     * Relasi ke model raport siswa.
     */
    public function kalender()
    {
        return $this->hasMany(Kalender_Sekolah::class, 'id_tahun_ajar');
    }
}
