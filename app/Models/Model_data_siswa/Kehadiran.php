<?php

namespace App\Models\Model_data_siswa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model ini.
     *
     * @var string
     */
    protected $table = 'kehadirans'; // Ganti dengan nama tabel yang sesuai

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
        'sakit',
        'izin',
        'alpha',
    
    ];

    /**
     * Relasi ke model Siswa.
     */
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    /**
     * Relasi ke model Semester.
     */
    public function semester()
    {
        return $this->belongsTo(Semester::class, 'id_semester');
    }

    /**
     * Relasi ke model TahunAjaran.
     */
    public function tahunAjaran()
    {
        return $this->belongsTo(tahun_ajaran::class, 'id_tahun_ajar');
    }
    /**
     * Relasi ke model Kelas.
     */
    public function kelas()
    {
        return $this->belongsTo(kelas::class, 'id_kelas');
    }
}
