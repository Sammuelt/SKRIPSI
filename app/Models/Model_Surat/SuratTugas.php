<?php

namespace App\Models\Model_Surat;

use App\Models\Guru;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratTugas extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'surat_mutasi_siswas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_guru',
        'tujuan_penugasan',
        'deskripsi',
        
    ];
     /**
     * Relasi ke model guru.
     */
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }
}
