<?php

namespace App\Services;

use RealRashid\SweetAlert\Facades\Alert;

class AlertServices
{
    public static function updateSuccess()
    {
        Alert::success('Sukses', 'Data berhasil diubah');
    }
    public static function storeSuccess()
    {
        Alert::success('Sukses', 'Data berhasil ditambahkan');
    }
    public static function destroySuccess()
    {
        Alert::success('Sukses', 'Data berhasil dihapus  ');
    }
}
