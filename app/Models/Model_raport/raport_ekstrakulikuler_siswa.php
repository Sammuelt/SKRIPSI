<?php

namespace App\Models\Model_raport;

use App\Models\Model_data_siswa\Extrakulikuler;
use App\Models\Model_data_siswa\Kelas;
use App\Models\Model_data_siswa\semester;
use App\Models\Model_data_siswa\Siswa;
use App\Models\Model_data_siswa\tahun_ajaran;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class raport_ekstrakulikuler_siswa extends Model
{
    use HasFactory;
    /**
  * fillable
  *
  * @var array
  */
 protected $fillable = [

    'id_kelas',
    'id_ekstrakulikuler',
    'id_siswa',
    'id_semester', 
    'id_tahun_ajar',  
    'predikat',
    'keterangan',
 ];
 
    /**
     * Relasi ke model Ekstrakulikuler.
     */
    public function ekstrakulikuler()
    {
        return $this->belongsTo(Extrakulikuler::class, 'id_ekstrakulikuler');
    }

    /**
     * Relasi ke model Siswa.
     */
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }
    
    /**
     * Relasi ke model kelas.
     */
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    /**
     * Relasi ke model Semester.
     */
    public function semester()
    {
        return $this->belongsTo(semester::class, 'id_semester');
    }

    /**
     * Relasi ke model TahunAjaran.
     */
    public function tahunAjaran()
    {
        return $this->belongsTo(tahun_ajaran::class, 'id_tahun_ajar');
    }
}
