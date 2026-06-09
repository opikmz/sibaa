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
        Schema::create('muzaki_perorangan', function (Blueprint $table) {
            $table->id('id_muzaki_perorangan');
            $table->string('nomor_registrasi')->unique();
            $table->string('nama');
            $table->string('npwz')->nullable();
            $table->string('npwp')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->string('tanggal_lahir');
            $table->enum('jk',['lk','pr']);
            $table->string('alamat');
            $table->string('no_handphone')->nullable();
            $table->text('keterangan')->nullable();
            $table->boolean('is_active')->default(true);
            // $table->timestamp('tanggal_registrasi');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('muzaki_perorangan');
    }
};
