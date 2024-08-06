<?php

namespace App\Http\Resources\Laporan;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Laporan_Keuangan_Resource extends JsonResource
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
            'tanggal' => $this->tanggal,
            'jenis_transaksi' => $this->jenis_transaksi,
            'jumlah' => $this->jumlah,
            'jumlah' => $this->jumlah,
            'keterangan' => $this->keterangan,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
