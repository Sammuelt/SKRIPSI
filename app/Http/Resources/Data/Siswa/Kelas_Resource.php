<?php

namespace App\Http\Resources\Data\Siswa;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Kelas_Resource extends JsonResource
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
            'nama_kelas' => $this->nama_kelas,
            
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
