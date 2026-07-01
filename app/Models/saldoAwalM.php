<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class saldoAwalM extends Model
{
    use HasFactory;
    protected $table = "saldo_awal";
    protected $primaryKey = "saldo_awal";
    protected $guarded = [];
}
