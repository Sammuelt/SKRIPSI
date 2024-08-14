<?php
namespace App\Models;

use App\Models\Model_data_siswa\Jadwal_pelajaran;
use App\Models\Model_data_siswa\Kelas;
use App\Models\Model_Surat\SuratTugas;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Guru extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_guru';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nomor_induk_pegawai',
        'nama',
        'alamat',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'pendidikan',
        'golongan',
        'status',
        'jabatan',
        'no_hp',
        'email',
    ];

    /**
     * Enumeration for 'jenis_kelamin'.
     *
     * @var array
     */
    public static $enumJenisKelamin = ['laki-laki', 'perempuan'];

    /**
     * Set the 'jenis_kelamin' attribute.
     *
     * @param  string  $value
     * @return void
     *
     * @throws \InvalidArgumentException
     */
    public function setJenisKelaminAttribute($value)
    {
        if (!in_array($value, self::$enumJenisKelamin)) {
            throw new \InvalidArgumentException("Jenis kelamin tidak valid");
        }

        $this->attributes['jenis_kelamin'] = $value;
    }

    /**
     * Relasi ke model Jadwal Pelajaran.
     */
    public function jadwal()
    {
        return $this->hasMany(Jadwal_pelajaran::class, 'id_guru');
    }
    /**
     * Relasi ke model Surat.
     */
    public function surat()
    {
        return $this->hasMany(SuratTugas::class, 'id_guru');
    }
    /**
     * Relasi ke model Surat.
     */
    public function walikelas()
    {
        return $this->hasMany(Kelas::class, 'id_walikelas');
    }
    /**
     * Relasi ke model account.
     */
    public function user()
    {
        return $this->hasMany(User::class, 'id_user');
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

