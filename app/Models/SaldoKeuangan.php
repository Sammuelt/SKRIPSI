<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaldoKeuangan extends Model
{
    use HasFactory;

    protected $fillable = [

        'Saldo_semua',
        'Saldo_bos',
        'Saldo_lain',
    ];
}
