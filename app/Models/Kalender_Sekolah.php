<?php

namespace App\Models;

use App\Models\Model_data_siswa\semester;
use App\Models\Model_data_siswa\tahun_ajaran;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kalender_Sekolah extends Model
{
    use HasFactory;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kalender__sekolah';
    /**
  * fillable
  *
  * @var array
  */
 protected $fillable = [
     
     'id_tahun_ajaran',
     'id_semester',
     'keterangan',
     'tanggal',
 ];
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
