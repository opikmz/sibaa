<?php

namespace App\Models;
use App\Models\muzakiPeroranganM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiM extends Model
{
    use HasFactory;
    protected $table = "transaksi";
    protected $primaryKey = "id_transaksi";
    protected $guarded = [];

    public function muzaki()
{
    return $this->belongsTo(
        muzakiPeroranganM::class,
        'muzaki_id',
        'id_muzaki_perorangan'
    );
}

}
