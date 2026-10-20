<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\muzakiPeroranganM;
use App\Models\pengeluaranM;
use App\Models\TransaksiM;
use Carbon\Carbon;
use App\Services\Keuangan;

class LaporanC extends Controller
{
    public function index()
    {
        $TransaksiPerTahun = TransaksiM::whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->get();
        $JumlahTransaksiPerTahun = $TransaksiPerTahun->sum('nominal');

        $pengeluaranPerTahun = pengeluaranM::whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->get();
        $jumlahPengeluaranPerTahun = $pengeluaranPerTahun->sum('nominal');
        // dd($pengeluaranPerTahun, $jumlahPengeluaranPerTahun);

        $penghimpunan = TransaksiM::get();
        $jumlahTransaksi = $penghimpunan->sum('nominal');
        $pengeluaran = pengeluaranM::get();
        $jumlahPengeluaran = $pengeluaran->sum('nominal');
        // ini belum dimasukan data awal
        $saldo = $jumlahTransaksi - $jumlahPengeluaran;

        // dd($jumlahPengeluaranPerTahun);
        $Muzaki = muzakiPeroranganM::all();
        $JumlahMuzaki = $Muzaki->count();

        $tahun = Carbon::now()->year;
        $dataTahun = [];
        for ($bulan = 1; $bulan <= 12; $bulan++) {
            $awalBulan = Carbon::create($tahun, $bulan, 1)->startOfMonth();
            $akhirBulan = Carbon::create($tahun, $bulan, 1)->endOfMonth();

            $dataTahun[$awalBulan->format('M')] = TransaksiM::whereBetween('created_at', [$awalBulan, $akhirBulan])->sum('nominal');
        }

        $dataPengeluaranBulanan = Keuangan::DataPengeluaranBulanan();

        // dd($dataPengeluaranBulanan);
        return view('pages.laporan.laporan', compact(
            'JumlahTransaksiPerTahun',
            'jumlahPengeluaranPerTahun',
            'saldo',
            'JumlahMuzaki',
            'dataTahun',
            'dataPengeluaranBulanan'
        ));
    }
}
