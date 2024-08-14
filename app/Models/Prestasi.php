<?php

namespace App\Models;

use App\Models\Model_data_siswa\Siswa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_siswa',
        'date',
        'title',
        'sub',
        'ket',
    ];

        /**
     * Relasi ke model siswa.
     */
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id');
    }
}
