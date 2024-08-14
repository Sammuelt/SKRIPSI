<?php

namespace App\Http\Resources\Data\Siswa;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Siswa_Resource extends JsonResource
{
       /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nisn' => $this->nisn,
            'nomor_induk_sekolah' => $this->nomor_induk_sekolah,
            'nama_lengkap' => $this->nama_lengkap,
            'jenis_kelamin' => $this->jenis_kelamin,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir,
            'alamat' => $this->alamat,
            'nama_orang_tua' => $this->nama_orang_tua,
            'no_hp_ortu' => $this->no_hp_ortu,
          
        ];
    }
}
