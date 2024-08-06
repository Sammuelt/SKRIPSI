<?php

namespace App\Http\Resources\Data\Siswa;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Kehadiran_Resource extends JsonResource
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
            
            'nama_lengkap' => $this->siswa ? $this->siswa->nama_lengkap : null,
            'nama_kelas' => $this->kelas ? $this->kelas->nama_kelas : null,
            'semester' => $this->semester ? $this->semester->semester : null,
            'tahun_ajaran' => $this->tahunAjaran ? $this->tahunAjaran->tahun_ajaran : null,
            'sakit' => $this->sakit,
            'izin' => $this->izin,
            'alpha' => $this->alpha,
        ];
    }
}
