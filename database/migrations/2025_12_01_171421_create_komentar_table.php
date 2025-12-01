<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('komentar', function (Blueprint $table) {
            $table->id('id_komentar');

            $table->unsignedBigInteger('id_prestasi');
            $table->string('nim_mahasiswa', 20);

            $table->text('isi_komentar');
            $table->timestamp('tanggal_komentar')->useCurrent();
            $table->enum('status', ['Tampil', 'Disembunyikan'])->default('Tampil');

            $table->foreign('id_prestasi')
                  ->references('id_prestasi')->on('prestasi')
                  ->onDelete('cascade');

            $table->foreign('nim_mahasiswa')
                  ->references('nim')->on('users_mahasiswa')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('komentar');
    }
};
