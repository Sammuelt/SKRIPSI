<?php

namespace App\Models;

use App\Models\Model_data_siswa\Kelas;
use App\Models\Model_data_siswa\Mata_pelajaran;
use App\Models\Model_data_siswa\semester;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TPCP extends Model
{
    use HasFactory;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tpcp';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'id_semester',
       'id_mapel',
       'id_kelas',
       'CP',
       'lingkup_materi',
    ];

    /**
     * Relasi ke model Semester.
     */
    public function semester()
    {
        return $this->hasMany(semester::class, 'id_semester');
    }
       /**
     * Relasi ke model Mata_pelajaran.
     */
    public function mapel()
    {
        return $this->belongsTo(Mata_pelajaran::class, 'id_mapel', 'id');
    }
    /**
     * Relasi ke model kelas.
     */
    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'id_kelas');
    }

}
