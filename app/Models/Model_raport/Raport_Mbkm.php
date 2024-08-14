<?php

namespace App\Models\Model_raport;


use App\Models\CapaianFase;
use App\Models\Mbkm_siswa;
use App\Models\Model_data_siswa\Kelas;
use App\Models\Model_data_siswa\Mata_pelajaran;
use App\Models\Model_data_siswa\semester;
use App\Models\Model_data_siswa\Siswa;
use App\Models\Model_data_siswa\tahun_ajaran;
use App\Models\RaportMbkmSiswa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Raport_Mbkm extends Model
{
    
    /**
     * Nama tabel yang terkait dengan model ini.
     *
     * @var string
     */
    protected $table = 'raport_mbkm';

    use HasFactory;
    /**
  * fillable
  *
  * @var array
  */
 protected $fillable = [

     'id_siswa',
     'id_kelas',
     'id_semester', 
     'id_tahun_ajar',  
     'id_project',  
     'id_capaian',  
     'id_nilai',


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
     * Relasi ke model TahunAjaran.
     */
    public function nilai_Mbkm()
    {
        return $this->belongsTo(RaportMbkmSiswa::class, 'id_nilai');
    }
  // Definisikan relasi ke model capaian_fase
  public function capaian_mbkm()
  {
      return $this->belongsTo(CapaianFase::class, 'id_capaian', );
  }
  
    /**
     * Relasi ke model TahunAjaran.
     */
    public function project_Mbkm()
    {
        return $this->belongsTo(Mbkm_siswa::class, 'id_project');
    }

}
