<?php

namespace App\Http\Resources\Laporan;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Laporan_Inventaris_Resource extends JsonResource
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
            'tgl_pembelian' => $this->tgl_pembelian,
            'dana_pembelian' => $this->dana_pembelian,
            'kode_barang' => $this->kode_barang,
            'nama_barang' => $this->nama_barang,
            'jumlah' => $this->jumlah,
            'kondisi' => $this->kondisi,
            'lokasi' => $this->lokasi,
            'keterangan' => $this->keterangan,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
