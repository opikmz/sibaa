<?php

namespace App\Http\Controllers;

use App\Models\pengeluaranM;
use App\Models\ProgramM;
use App\Models\TransaksiM;
use App\Services\AlertServices;
use App\Services\Keuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\PenghimpunanProgramExport;
use Maatwebsite\Excel\Facades\Excel;

class ProgramC extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $program = programM::get();
        $totalPenghimpunanPerProgram = Keuangan::TotalSemuaPenghimpunanPerProgram();


        // dd($program->program);
        return view('pages.program.program', compact('program', 'totalPenghimpunanPerProgram'));
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
        // dd($request->program);
        $request->validate([
            'program' => 'required|string|max:100',
            // 'kategori'   => 'required|in:infaq,zakat',
        ]);

        ProgramM::create([
            'program' => $request->program,
            'kategori' => $request->kategori,
            'target_penghimpunan' => $request->target_penghimpunan,
            'is_active' => true,
        ]);
        AlertServices::storeSuccess();
        return redirect()->route('program');
    }

    /**
     * Display the specified resource.
     */
    public function show(programM $program)
    {
        $pengeluaranProgram = pengeluaranM::where('program_id', $program->id_program)->get();
        $penghimpunanProgram = TransaksiM::with('muzaki')
            ->where('program_id', $program->id_program)
            ->get();
        $totalPenghimpunanPerProgram = Keuangan::TotalPenghimpunanSatuProgram($program->id_program);
        $totalPengeluaranPerProgram = Keuangan::TotalPengenluaranSatuProgram($program->id_program);
        // dd($totalPengeluaranPerProgram);

        $progresPengeluaran = ($program->target_penghimpunan > 0)
            ? ($totalPengeluaranPerProgram / $program->target_penghimpunan) * 100
            : 0;

        $progresPenghimpunan = ($program->target_penghimpunan > 0)
            ? ($totalPenghimpunanPerProgram / $program->target_penghimpunan) * 100
            : 0;

        $progresPenghimpunan = min($progresPenghimpunan, 100);

        $penghimpunanHarian = Keuangan::PenghimpunanHarianPerProgram($program->id_program);

        // dd($pengeluaranProgram, $penghimpunanProgram);
        return view('pages.program.show_program', compact(
            'program',
            'penghimpunanProgram',
            'pengeluaranProgram',
            'totalPenghimpunanPerProgram',
            'progresPenghimpunan',
            'penghimpunanHarian',
            'progresPengeluaran',
            'totalPengeluaranPerProgram',
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(programM $programM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProgramM $program)
    {

        $request->validate([
            'program' => 'required|string|max:100',
            // 'kategori'   => 'required|in:infaq,zakat',
        ]);
        // dd($request->program);

        $program->update([
            'program' => $request->program,
            'kategori' => $request->kategori,
        ]);
        AlertServices::updateSuccess();
        return redirect()->route('program');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(programM $program)
    {
        if ($program->is_active == 1) {
            $program->update([
                'is_active' => 0
            ]);
        } else {
            $program->update([
                'is_active' => 1
            ]);
        }

        AlertServices::updateSuccess();
        return redirect()->back();
    }
    public function exportPenghimpunan($id)
    {
        $program = ProgramM::findOrFail($id);

        $namaProgram = preg_replace(
            '/[\/\\\\:*?"<>|]/',
            '',
            $program->program
        );

        $namaFile = 'Penghimpunan Program ' . trim($namaProgram) . '.xlsx';

        return Excel::download(
            new PenghimpunanProgramExport($id),
            $namaFile
        );
    }
}
