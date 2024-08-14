<?php

namespace App\Http\Resources\Data\Siswa;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Mapel_Resource extends JsonResource
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
            'nama_pelajaran' => $this->nama_pelajaran,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
