<?php

namespace App\Models;

use App\Models\Model_raport\Raport_Mbkm;
use App\Models\Mbkm_siswa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapaianFase extends Model
{
    use HasFactory;
      /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'capaian_fases';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'element',
        'sub_elemen',
       
    ];

    public function raport_mbkm()
    {
        return $this->hasMany(Raport_Mbkm::class, 'id_capaian');
    }
    
    public function Mbkm_siswa()
    {
        return $this->belongsTo(Mbkm_siswa::class, 'id_project');
    }
    
}
