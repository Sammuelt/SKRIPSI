<?php

namespace App\Models\Model_data_siswa;

use App\Models\Model_raport\raport_ekstrakulikuler_siswa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extrakulikuler extends Model
{
    use HasFactory;
    /**
  * fillable
  *
  * @var array
  */
 protected $fillable = [
   
     'ekstrakulikuler',
     
 ];
 public function raport_ekstrakulikuler()
 {
     return $this->hasMany(raport_ekstrakulikuler_siswa::class, 'id_ekstrakulikuler');
 }
}
