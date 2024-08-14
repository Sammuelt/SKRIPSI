<?php

namespace App\Models\Model_laporan;

use App\Models\StandartHarga;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Inventaris_barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'tgl_pembelian',
        'dana_pembelian',
        'id_barang',
        'jumlah',
        'kondisi',
        'lokasi',
        'total_biaya',
        'keterangan',
    ];

    public static $enumKondisi = ['sangat_bagus', 'bagus', 'cukup_bagus', 'tidak_bagus', 'rusak'];

    public function setKondisiAttribute($value)
    {
        if (!in_array($value, self::$enumKondisi)) {
            throw new \InvalidArgumentException("Kondisi tidak valid");
        }
        $this->attributes['kondisi'] = $value;
    }
    public static $enumDana = ['Dana Bos', 'lain-lain'];

    public function setDanaAttribute($value)
    {
        if (!in_array($value, self::$enumDana)) {
            throw new \InvalidArgumentException("Kondisi tidak valid");
        }
        $this->attributes['dana_pembelian'] = $value;
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            Log::info('Creating model: ', $model->toArray());
        });

        static::created(function ($model) {
            Log::info('Created model: ', $model->toArray());
        });
        static::updating(function ($model) {
            Log::info('Updating model: ', $model->toArray());
        });

        static::updated(function ($model) {
            Log::info('Updated model: ', $model->toArray());
        });
    }

    public function barang()
    {
        return $this->belongsTo(StandartHarga::class, 'id_barang');
    }

}

