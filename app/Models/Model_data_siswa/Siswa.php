<?php

namespace App\Models\Model_data_siswa;

use App\Models\Model_raport\raport_ekstrakulikuler_siswa;
use App\Models\Model_raport\Raport_Mbkm;
use App\Models\Model_raport\Raport_siswa;
use App\Models\Prestasi;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model ini.
     *
     * @var string
     */
    protected $table = 'tbl_data_siswa';

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'nisn',
        'id_kelas_now',
        'nama_lengkap',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'nama_orang_tua',
        'no_hp_ortu',
      
    ];

    public static $enumJenisKelamin = ['laki-laki', 'perempuan'];

    // Opsi lain: validasi di sini
    public function setJenisKelaminAttribute($value)
    {
        if (!in_array($value, self::$enumJenisKelamin)) {
            throw new \InvalidArgumentException("Jenis kelamin tidak valid");
        }

        $this->attributes['jenis_kelamin'] = $value;
    }
    
    /**
     * Relasi ke model Kehadiran.
     */
    public function kehadiran()
    {
        return $this->hasMany(Kehadiran::class, 'id_siswa');
    }

    /**
     * Relasi ke model raport ekstrakulikuler.
     */
    public function raport_ekstrakulikuler()
    {
        return $this->hasMany(raport_ekstrakulikuler_siswa::class, 'id_siswa');
    }
    /**
     * Relasi ke model raport siswa.
     */
    public function raport_siswa()
    {
        return $this->hasMany(Raport_siswa::class, 'id_siswa');
    }
      /**
     * Relasi ke model raport siswa.
     */
    public function raport_mbkm()
    {
        return $this->hasMany(Raport_Mbkm::class, 'id_siswa');
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas_now');
    }
        /**
     * Relasi ke model account.
     */
    public function prestasi()
    {
        return $this->belongsTo(Prestasi::class, 'id_siswa');
    }
    public function User_id()
    {
        return $this->belongsTo(User::class, 'id_wali');
    }

}
