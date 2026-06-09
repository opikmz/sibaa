<?php

namespace App\Http\Controllers;

use App\Models\muzakiPeroranganM;
use App\Models\TransaksiM;
use App\Services\AlertServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class MuzakiC extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexp()
    {
        $muzakiPerorangan = muzakiPeroranganM::get()->all();
        return view('pages.muzaki.perorangan.muzaki_perorangan', compact('muzakiPerorangan'));
    }

    private function GenerateNomorRegister()
    {
        return DB::transaction(function () {
            $last = DB::table('muzaki_perorangan')
                ->lockForUpdate()
                ->orderBy('id_muzaki_perorangan', 'desc')
                ->first();
            if (!$last) {
                return 'A-000001';
            }
            [$latter, $number] = explode('-', $last->nomor_registrasi);
            $number = (int) $number;

            if ($number < 999999) {
                $number++;
            } else {
                $number = 1;
                $latter = chr(ord($latter) + 1);
            }
            return $latter . '-' . str_pad($number, 6, '0', STR_PAD_LEFT);
        });
    }

    public function createp()
    {
        return view('pages.muzaki.perorangan.create_muzaki_perorangan');
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storep(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'npwz' => 'nullable|string|max:30',
            'npwp' => 'nullable|string|max:30',
            'tempat_lahir' => 'nullable|string|max:30',
            'tanggal_lahir' => 'nullable|date',
            'jk' => 'required',
            'alamat' => 'required|string',
            'no_handphone' => 'required|regex:/^08[0-9]{8,12}$/',
            'keterangan' => 'nullable|string|max:200',
        ], [
            'nama.required' => 'Nama wajib diisi',
            'jk.required' => 'Jenis kelamin wajib di isi',
            'alamat.required' => 'Alamat wajib di isi',
            'no_handphone.required' => 'No Handphone wajib di isi',
            'no_handphone.regex' => 'Format No Handphone tidak valid',
        ]);
        // dd('here');

        // dd($this->GenerateNomorRegister());
        // $tanggal_registrasi =
        muzakiPeroranganM::create([
            'nomor_registrasi' => $this->GenerateNomorRegister(),
            'nama' => $request->nama,
            'npwz' => $request->npwz,
            'npwp' => $request->npwp,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jk' => $request->jk,
            'alamat' => $request->alamat,
            'no_handphone' => $request->no_handphone,
            // 'tanggal_registrasi' => $request->tanggal_registrasi,
        ]);
        AlertServices::storeSuccess();
        return redirect()->route('muzaki_perorangan');
    }
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function showp(muzakiPeroranganM $muzakip)
    {

        $transaksi = TransaksiM::where('muzaki_id', $muzakip->id_muzaki_perorangan)->get();
        return view('pages.muzaki.perorangan.show_muzaki_perorangan', compact('muzakip', 'transaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editp(muzakiPeroranganM $muzakip)
    {
        return view('pages.muzaki.perorangan.edit_muzakip', compact('muzakip'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatep(Request $request, muzakiPeroranganM $muzakip)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'npwz' => 'nullable|string|max:30',
            'npwp' => 'nullable|string|max:30',
            'tempat_lahir' => 'nullable|string|max:30',
            'tanggal_lahir' => 'nullable|date',
            'jk' => 'required',
            'alamat' => 'required|string',
            'no_handphone' => 'required|regex:/^08[0-9]{8,12}$/',
            'keterangan' => 'nullable|string|max:200',
        ], [
            'nama.required' => 'Nama wajib diisi',
            'jk.required' => 'Jenis kelamin wajib di isi',
            'alamat.required' => 'Alamat wajib di isi',
            'no_handphone.required' => 'No Handphone wajib di isi',
            'no_handphone.regex' => 'Format No Handphone tidak valid',
        ]);
        $muzakip->update([
            'nama' => $request->nama,
            'npwz' => $request->npwz,
            'npwp' => $request->npwp,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jk' => $request->jk,
            'alamat' => $request->alamat,
            'no_handphone' => $request->no_handphone,
        ]);

        AlertServices::updateSuccess();
        return redirect()->route('muzaki_perorangan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyp(muzakiPeroranganM $muzakip)
    {
        if($muzakip->is_active == 1){
            $muzakip->update([
                'is_active' => 0
            ]);
        } else {
               $muzakip->update([
                'is_active' => 1
            ]);
        }

        AlertServices::destroySuccess();
        return redirect()->back();
    }
}
