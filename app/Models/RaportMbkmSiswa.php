<?php

namespace App\Models;

use App\Models\Model_raport\Raport_Mbkm;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaportMbkmSiswa extends Model
{
    use HasFactory;
      /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'nilai_projek';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nilai',
    ];

    /**
     * Enumeration for 'nilai'.
     *
     * @var array
     */
    public static $enumNilai = ['BB', 'MB','BSH', 'SB'];

    /**
     * Set the 'nilai' attribute.
     *
     * @param  string  $value
     * @return void
     *
     * @throws \InvalidArgumentException
     */
    public function setNilaiAttribute($value)
    {
        if (!in_array($value, self::$enumNilai)) {
            throw new \InvalidArgumentException(" nilai tidak valid");
        }

        $this->attributes['nilai'] = $value;
    }
    /**
     * Relasi ke model Jadwal Pelajaran.
     */
    public function raport_mbkm()
    {
        return $this->hasMany(Raport_Mbkm::class, 'id_nilai');
    }
}
