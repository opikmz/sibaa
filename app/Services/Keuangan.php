<?php

namespace App\Services;

use App\Models\transaksiM;
use App\Models\pengeluaranM;
use App\Models\saldoAwalM;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Keuangan
{
    public static function saldo()
    {
        $tahunan = saldoAwalM::sum('nominal');
        $masuk = TransaksiM::sum('nominal');
        $keluar = pengeluaranM::sum('nominal');

        return $masuk + $tahunan - $keluar;
    }


    // ========================= Penghimpunan =========================


    public static function DataPenghimpunanBulanan($tahun = null)
    {
        $tahun = $tahun ?? Carbon::now()->year;
        $dataPenghimpunanBulanan = [];

        for ($bulan = 1; $bulan <= 12; $bulan++) {
            $awalBulan = Carbon::create($tahun, $bulan, 1)->startOfMonth();
            $akhirBulan = Carbon::create($tahun, $bulan, 1)->endOfMonth();

            $dataPenghimpunanBulanan[$awalBulan->format('M')] = TransaksiM::whereBetween('created_at', [$awalBulan, $akhirBulan])->sum('nominal');
        }
        return $dataPenghimpunanBulanan;
    }

    public static function TotalPenghimpunanBulanIni()
    {
        return TransaksiM::whereYear('created_at', now()->year)->whereMonth('created_at', now()->month)->sum('nominal');
    }

    public static function TotalPenghimpunanTahunIni()
    {
        return TransaksiM::whereYear('created_at', now()->year)->sum('nominal');
    }

    // ========================= Pengeluaran =========================


    public static function DataPengeluaranBulanan($tahun = null)
    {
        $tahun = $tahun ?? Carbon::now()->year;
        $dataPengeluaranBulanan = [];

        for ($bulan = 1; $bulan <= 12; $bulan++) {
            $awalBulan = Carbon::create($tahun, $bulan, 1)->startOfMonth();
            $akhirBulan = Carbon::create($tahun, $bulan, 1)->endOfMonth();

            $dataPengeluaranBulanan[$awalBulan->format('M')] = pengeluaranM::whereBetween('created_at', [$awalBulan, $akhirBulan])->sum('nominal');
        }
        return $dataPengeluaranBulanan;
    }


    public static function TotalPengeluaranBulanIni()
    {
        return pengeluaranM::whereYear('created_at', now()->year)->whereMonth('created_at', now()->month)->sum('nominal');
    }

    public static function TotalPengeluaranTahunIni()
    {
        return pengeluaranM::whereYear('created_at', now()->year)->sum('nominal');
    }

    public static function TotalSemuaPenghimpunanPerProgram()
    {
        return TransaksiM::select(
            'program_id',
            DB::raw('SUM(nominal) as total')
        )
            ->groupBy('program_id')
            ->pluck('total', 'program_id');
    }

    public static function TotalPenghimpunanSatuProgram($programId)
    {
        return TransaksiM::where('program_id', $programId)
            ->sum('nominal');
    }
    public static function TotalPengenluaranSatuProgram($programId)
    {
        return pengeluaranM::where('program_id', $programId)
            ->sum('nominal');
    }

    public static function PenghimpunanHarianPerProgram($programId)
    {
        return TransaksiM::where('program_id', $programId)
            ->select(
                DB::raw('DATE(created_at) as tanggal'),
                DB::raw('SUM(nominal) as total')
            )
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('tanggal')
            ->get();
    }
}
