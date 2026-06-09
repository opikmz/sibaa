<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('id_transaksi');
            
            $table->string('nomor_transaksi')->unique();
            $table->decimal('nominal', 15, 2);

            $table->enum('tipe_muzaki', ['perorangan', 'kelompok']);
            $table->enum('kategori_transaksi', ['zakat', 'infaq']);

            $table->unsignedBigInteger('program_id');
            $table->foreign('program_id')
                ->references('id_program')
                ->on('program')
                ->restrictOnDelete();

            $table->unsignedBigInteger('muzaki_id')->nullable();
            $table->foreign('muzaki_id')
                ->references('id_muzaki_perorangan')
                ->on('muzaki_perorangan')
                ->nullOnDelete();

            $table->text('keterangan')->nullable();
            // $table->id('id_transaksi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
