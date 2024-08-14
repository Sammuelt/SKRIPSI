<?php

namespace App\Http\Resources\Raport;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Raport_Mbkm_Resource extends JsonResource
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
            'judul_proyek' => $this->judul_proyek,
            'deskripsi' => $this->deskripsi,
            'beriman' => $this->beriman,
            'berkebinakaan' => $this->berkebinakaan,
            'kreatif1' => $this->kreatif1,
            'kreatif2' => $this->kreatif2,
            'gotong_royong' => $this->gotong_royong,
            'catatan_proses' => $this->catatan_proses,

        ];
    }
}
