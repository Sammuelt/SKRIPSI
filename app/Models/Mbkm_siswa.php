<?php

namespace App\Models;

use App\Models\Model_raport\Raport_Mbkm;
use App\Models\CapaianFase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mbkm_siswa extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mbkm_siswas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'judul',
        'description',
        'capaian_proses',
    ];

    

      /**
     * Relasi ke model raport_Mbkm.
     */
    public function raport_Mbkm()
    {
        return $this->belongsTo(Raport_Mbkm::class, 'id_project');
    }
}
