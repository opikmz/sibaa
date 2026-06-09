<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class muzakiPeroranganM extends Model
{
    use HasFactory;
    protected $table = "muzaki_perorangan";
    protected $primaryKey = "id_muzaki_perorangan";
    protected $guarded = [];
}
