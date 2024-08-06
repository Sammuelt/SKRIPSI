<?php

namespace App\Models\Model_data_siswa;

use App\Models\Model_raport\Raport_siswa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mata_pelajaran extends Model
{
    use HasFactory;
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
        return $this->hasMany(Raport_siswa::class, 'id_mapel');
    }
}
