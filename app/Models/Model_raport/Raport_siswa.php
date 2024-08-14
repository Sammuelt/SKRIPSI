<?php

namespace App\Models\Model_raport;

use App\Models\Model_data_siswa\Kelas;
use App\Models\Model_data_siswa\Mata_pelajaran;
use App\Models\Model_data_siswa\semester;
use App\Models\Model_data_siswa\Siswa;
use App\Models\Model_data_siswa\tahun_ajaran;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Raport_siswa extends Model
{
    use HasFactory;
    /**
  * fillable
  *
  * @var array
  */
 protected $fillable = [
     'id_tahun_ajar',
     'id_semester',
     'id_siswa',
     'id_kelas',
     'id_mapel',       
     'nilai',
     'kekurangan_kompetensi',
     'kelebihan_kompetensi',
     'keterangan',
 ];
 
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
    /**
     * Relasi ke model Mapel.
     */
    public function mapel()
    {
        return $this->belongsTo(Mata_pelajaran::class, 'id_mapel');
    }
}
