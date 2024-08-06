<?php

namespace App\Http\Resources\Data\Siswa;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class jadwal_Mapel_Resource extends JsonResource
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
            'hari' => $this->hari,
            'nama_pelajaran' =>$this->mapel? $this->mapel->nama_pelajaran:null,  // --> data pelajaran  meurpakan ralasi dari tabel mata_pelajarans    
            'kelas' => $this->kelas?$this->kelas->nama_kelas:null,  // --> data kelas  meurpakan ralasi dari tabel kelas   
            'guru' =>$this->guru? $this->guru->nama:null,  // --> data guru  meurpakan ralasi dari tbl_guru   
            'jam_mulai' => $this->jam_mulai,
            'jam_selesai' => $this->jam_selesai,
        
        ];
    }
}
