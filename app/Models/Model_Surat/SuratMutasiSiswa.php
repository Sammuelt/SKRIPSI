<?php

namespace App\Models\Model_Surat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMutasiSiswa extends Model
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
        'id_kelas_ditinggalkan',
        'nama',
        'alamat',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'pendidikan',
        'golongan',
        'no_hp',
        'email',
    ];
}
