<?php

namespace App\Http\Resources\Raport;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Raport_Siswa_Resource extends JsonResource
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
            'nama_pelajaran' => $this->mapel ? $this->mapel->nama_pelajaran : null,
            'nilai' => $this->nilai,
            'kelebihan_kompetensi' => $this->kelebihan_kompetensi,
            'kekurangan_kompetensi' => $this->kekurangan_kompetensi,
        ];
    }
}
