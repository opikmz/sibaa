<?php

namespace App\Http\Controllers;

use App\Models\saldoAwalM;
use App\Services\AlertServices;
use Illuminate\Http\Request;

class SaldoDanaAwal extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $danaAwal = saldoAwalM::get()->all();
        // dd($danaAwal);
        return view('pages.transaksi.saldo_dana_awal',compact('danaAwal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd('ini');
        $request->validate([
            // 'tahun' => 'required|unique:saldo_awal,tahun',
            'nominal' => 'required|string|max:100',
        ]);

        $saldoDanaAwal = saldoAwalM::create([
            'tahun' => $request->tahun,
            'nominal' => $request->nominal,
        ]);

        AlertServices::storeSuccess();
        return redirect()->route('saldo_dana_awal');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(saldoAwalM $danaAwal)
    {
        return view('pages.transaksi.edit_dana_awal',compact('danaAwal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
