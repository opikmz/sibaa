<?php

namespace App\Http\Controllers;

use App\Models\muzakiPeroranganM;
use App\Models\pengeluaranM;
use App\Models\TransaksiM;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\Keuangan;

class DashboardC extends Controller
{
    public function index()
    {
        $TransaksiPerTahun = TransaksiM::whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->get();
        $JumlahTransaksiPerTahun = $TransaksiPerTahun->sum('nominal');

        $pengeluaranPerTahun = pengeluaranM::whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->get();
        $jumlahPengeluaranPerTahun = $pengeluaranPerTahun->sum('nominal');

        $penghimpunan = TransaksiM::get();
        $jumlahTransaksi = $penghimpunan->sum('nominal');
        $pengeluaran = pengeluaranM::get();
        $jumlahPengeluaran = $pengeluaran->sum('nominal');

        $pengeluaranPerBulan = Keuangan::TotalPengeluaranBulanIni();
        $penghimpunanPerBulan = Keuangan::TotalPenghimpunanBulanIni();
        $penghimpunanPerTahun = Keuangan::TotalPenghimpunanTahunIni();
        $saldo = Keuangan::saldo();


        // dd($jumlahPengeluaranPerTahun);
        $Muzaki = muzakiPeroranganM::all();
        $JumlahMuzaki = $Muzaki->count();
        $totalPenghimpunanPerProgram = Keuangan::TotalSemuaPenghimpunanPerProgram();
        $dataPenghimpunanBulanan = Keuangan::DataPenghimpunanBulanan();
        $dataPengeluaranBulanan = Keuangan::DataPengeluaranBulanan();
// dd($dataPengeluaranBulanan);
        // dd($dataPenghimpunanBulanan);
        return view('pages.dashboard', compact('TransaksiPerTahun', 'JumlahTransaksiPerTahun', 'JumlahMuzaki', 'dataPenghimpunanBulanan', 'jumlahPengeluaranPerTahun', 'saldo', 'pengeluaranPerBulan', 'penghimpunanPerBulan','dataPenghimpunanBulanan','dataPengeluaranBulanan'));
    }
}
