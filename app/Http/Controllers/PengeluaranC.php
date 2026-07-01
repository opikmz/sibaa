<?php

namespace App\Http\Controllers;

use App\Models\pengeluaranM;
use App\Models\ProgramM;
use App\Services\AlertServices;
use Illuminate\Http\Request;

class PengeluaranC extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengeluaran = pengeluaranM::get()->all();
        // $program = pengeluaranM::get()->all();
        return view('pages.transaksi.pengeluaran.pengeluaran', compact('pengeluaran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $program = ProgramM::get()->all();
        return view('pages.transaksi.pengeluaran.create_pengeluaran', compact('program'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pengeluaran' => 'required|string|max:100',
            'nominal' => 'required|string|max:100',
        ]);
        $pengeluaran = pengeluaranM::create([
            'pengeluaran' => $request->pengeluaran,
            'nominal' => $request->nominal,
        ]);

        AlertServices::storeSuccess();
        return redirect()->route('pengeluaran');
    }

    /**
     * Display the specified resource.
     */
    public function show(pengeluaranM $pengeluaranM)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pengeluaranM $pengeluaran)
    {
        $program = ProgramM::get()->all();
        return view('pages.transaksi.pengeluaran.edit_pengeluaran', compact('pengeluaran', 'program'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, pengeluaranM $pengeluaran)
    {
        $request->validate([
            'pengeluaran' => 'required|string|max:100',
            'nominal' => 'required|string|max:100',
        ]);

        $pengeluaran->update([
            'pengeluaran' => $request->pengeluaran,
            'nominal' => $request->nominal,
            'program_id' => $request->program_id,
            'keterangan' => $request->keterangan,
        ]);

        AlertServices::updateSuccess();
        return redirect()->route('pengeluaran');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pengeluaranM $pengeluaran)
    {
        $pengeluaran->delete();
        AlertServices::destroySuccess();
        return redirect()->route('pengeluaran');
    }
}
