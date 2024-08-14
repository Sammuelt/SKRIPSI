<?php

namespace App\Http\Resources\Data\Siswa;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TahunajaranResource extends JsonResource
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
            'tahun_ajaran' => $this->tahun_ajaran,
          
        ];
    }
}
