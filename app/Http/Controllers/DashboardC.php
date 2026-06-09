<?php

namespace App\Http\Controllers;

use App\Models\muzakiPeroranganM;
use Carbon\Carbon;
use App\Models\TransaksiM;
use Illuminate\Http\Request;

class DashboardC extends Controller
{
    public function index()
    {
        $TransaksiPerTahun = TransaksiM::whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->get();
        $JumlahTransaksiPerTahun = $TransaksiPerTahun->sum('nominal');
        $Muzaki = muzakiPeroranganM::all();
        $JumlahMuzaki = $Muzaki->count();

        $tahun = Carbon::now()->year;
        $dataTahun = [];
        for($bulan = 1; $bulan <=12; $bulan++){
            $awalBulan = Carbon::create($tahun,$bulan,1)->startOfMonth();
            $akhirBulan = Carbon::create($tahun,$bulan,1)->endOfMonth();

            $dataTahun [$awalBulan->format('M')] = TransaksiM::whereBetween('created_at',[$awalBulan,$akhirBulan])->sum('nominal');
        }
        // dd($dataTahun);
        return view('pages.dashboard', compact('TransaksiPerTahun','JumlahTransaksiPerTahun','JumlahMuzaki','dataTahun'));
    }
}
