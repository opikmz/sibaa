<?php

use App\Http\Controllers\DashboardC;
use App\Http\Controllers\MuzakiC;
use App\Http\Controllers\programC;
use App\Http\Controllers\SaldoDanaAwal;
use App\Http\Controllers\TransaksiC;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('pages.dashboard');
});
Route::get('/', [DashboardC::class, 'index'])
    ->name('dashboard');

Route::get('/muzaki_perorangan', [MuzakiC::class, 'indexp'])
    ->name('muzaki_perorangan');
Route::get('/create_muzaki_perorangan', [MuzakiC::class, 'createp'])
    ->name('create_muzaki_perorangan');
Route::post('/store_muzakip', [MuzakiC::class, 'storep'])
    ->name('store_muzakip');
Route::get('/edit_muzaki_perorangan/{muzakip}', [MuzakiC::class, 'editp'])
    ->name('edit_muzaki_perorangan');
Route::get('/show_muzaki_perorangan/{muzakip}', [MuzakiC::class, 'showp'])
    ->name('show_muzaki_perorangan');

Route::post('/update_muzakip/{muzakip}', [MuzakiC::class, 'updatep'])
    ->name('update_muzakip');

Route::delete('/destroy_muzakip/{muzakip}', [MuzakiC::class, 'destroyp'])
    ->name('destroy_muzakip');

Route::get('/program', [ProgramC::class, 'index'])
    ->name('program');
Route::post('/store_program', [ProgramC::class, 'store'])
    ->name('store_program');

Route::get('/transaksi/create', [TransaksiC::class, 'create'])
    ->name('transaksi.create');
Route::post('/store_transaksi', [TransaksiC::class, 'store'])
    ->name('store_transaksi');

Route::get('/penghimpunan', [TransaksiC::class, 'indexp'])
    ->name('penghimpunan_perorangan');

Route::get('/transaksi/edit', [TransaksiC::class, 'edit'])
    ->name('transaksi.edit');

Route::get('/show_transaksi/{transaksi}', [TransaksiC::class, 'show'])
    ->name('transaksi.show');
    

// Saldo dana awal
Route::get('/saldo_dana_awal', [SaldoDanaAwal::class, 'index'])
    ->name('saldo_dana_awal.index');

Route::post('/store_saldo_dana_awal', [SaldoDanaAwal::class, 'store'])
    ->name('store_dana_awal');
