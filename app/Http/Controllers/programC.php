<?php

namespace App\Http\Controllers;

use App\Models\ProgramM;
use Illuminate\Http\Request;
use App\Services\AlertServices;

class ProgramC extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $program = programM::get()->all();
        // dd($program);
        return view('pages.program.program',compact('program'));
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
            'kategori'   => 'required|in:infaq,zakat',
        ]);

        ProgramM::create([
            'program' => $request->program,
            'kategori' => $request->kategori,
            'is_active' => true,
        ]);
        AlertServices::storeSuccess();
        return redirect()->route('program');
    }

    /**
     * Display the specified resource.
     */
    public function show(programM $programM)
    {
        //
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
    public function update(Request $request, ProgramM $programM)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(programM $programM)
    {
        //
    }
}
