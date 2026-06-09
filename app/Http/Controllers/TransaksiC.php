<?php

namespace App\Http\Controllers;

use App\Models\muzakiPeroranganM;
use App\Models\ProgramM;
use App\Models\TransaksiM;
use App\Services\AlertServices;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransaksiC extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexp()
    {
        $transaksi = TransaksiM::latest()->get();
        return view('pages.transaksi.penghimpunan_perorangan', compact('transaksi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $tipe = $request->query('tipe');
        $id = $request->query('id');
        $program = ProgramM::get()->all();
        if ($tipe === 'perorangan') {
            $muzaki = muzakiPeroranganM::findOrFail($id);

            return view('pages.transaksi.create_transaksi', compact('muzaki', 'tipe', 'program'));
        }
        if ($tipe === 'lembaga') {
            $muzaki = muzakiPeroranganM::findOrFail($id);

            return view('pages.transaksi.create_transaksi', compact('muzaki', 'tipe', 'program'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'muzaki_id' => 'required|string|max:100',
            'tipe_muzaki' => 'required|string|max:100',
            'nominal' => 'required|string|max:100',
            'program_id'   => 'required',
        ]);
        $program = $request->program_id;

        $now = Carbon::now();
        $time = $now->format('His');
        $date = $now->format('dmY');


        $nomorTransaksi = $program . ' ' . $time . ' ' . $date;
        $program = ProgramM::find($request->program_id);

        $kategori_transaksi = $program->kategori;

        $transaksi = TransaksiM::create([
            'nomor_transaksi' => $nomorTransaksi,
            'muzaki_id' => $request->muzaki_id,
            'tipe_muzaki' => $request->tipe_muzaki,
            'kategori_transaksi' => $kategori_transaksi,
            'nominal' => $request->nominal,
            'program_id' => $request->program_id,
            'keterangan' => $request->keterangan,
        ]);
        // dd($idTransaksi->id_transaksi);

        AlertServices::storeSuccess();
        return redirect()->route('penghimpunan_perorangan');

        // return view('pages.transaksi.struk', compact('transaksi'));
    }

    /**
     * Display the specified resource.
     */
    public function  show(TransaksiM $transaksi)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TransaksiM $transaksiM, Request $request)
    {
        $tipe = $request->query('tipe');
        $id = $request->query('id');
        $program = ProgramM::get()->all();
        if ($tipe === 'perorangan') {
            $muzaki = muzakiPeroranganM::findOrFail($id);

            return view('pages.transaksi.edit_penghimpunan', compact('muzaki', 'tipe', 'program'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TransaksiM $transaksiM)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransaksiM $transaksiM)
    {
        //
    }
}
