<?php

namespace App\Http\Resources\Surat;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SuratTugas extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nomor_induk_pegawai' => $this->guru ? $this->guru->nomor_induk_pegawai : null,
            'nama' => $this->guru ? $this->guru->nama : null,
            'tujuan_penugasan' => $this->tujuan_penugasan,
            'deskripsi' => $this->deskripsi,
        ];
    }
}
