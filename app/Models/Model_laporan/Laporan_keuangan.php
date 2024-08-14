<?php

namespace App\Models\Model_laporan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Laporan_keuangan extends Model
{
    /**
     * Nama tabel yang terkait dengan model ini.
     *
     * @var string
     */
    protected $table = 'laporan_keuangan';

    use HasFactory;
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [

        'tanggal',
        'jenis_transaksi',
        'dana',
        'jumlah',
        'keterangan',
    ];

    public static $enumJenisTransaksi = ['uang_masuk', 'uang_keluar'];

    // Opsi lain: validasi di sini
    public function setjenistransaksiAttribute($value)
    {
        if (!in_array($value, self::$enumJenisTransaksi)) {
            throw new \InvalidArgumentException("Jenis Transaksi tidak valid");
        }

        $this->attributes['jenis_transaksi'] = $value;
    }

    public static $enumDana = ['Dana Bos', 'lain-lain'];

    // Opsi lain: validasi di sini
    public function setDanaAttribute($value)
    {
        if (!in_array($value, self::$enumDana)) {
            throw new \InvalidArgumentException("Jenis Transaksi tidak valid");
        }

        $this->attributes['dana'] = $value;
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
}
