<?php
namespace App\Http\Resources\Data\Guru;

use Illuminate\Http\Resources\Json\JsonResource;

class GuruResource extends JsonResource
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
            'nomor_induk_pegawai' => $this->nomor_induk_pegawai,
            'nama' => $this->nama,
            'alamat' => $this->alamat,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir,
            'jenis_kelamin' => $this->jenis_kelamin,
            'pendidikan' => $this->pendidikan,
            'golongan' => $this->golongan,
            'no_hp' => $this->no_hp,
            'email' => $this->email,
        ];
    }
}
