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
        Schema::create('komentar', function (Blueprint $table) {
            $table->id('id_komentar');

            // relasi ke prestasi & mahasiswa
            $table->unsignedBigInteger('id_prestasi');
            $table->string('nim_mahasiswa', 20);

            $table->text('isi_komentar');
            $table->dateTime('tanggal_komentar');  // bisa diisi now() saat insert

            $table->enum('status', ['Tampil', 'Disembunyikan'])
                ->default('Tampil');

            $table->timestamps();

            // foreign key
            $table->foreign('id_prestasi')
                ->references('id_prestasi')
                ->on('prestasi')
                ->cascadeOnDelete();

            $table->foreign('nim_mahasiswa')
                ->references('nim')
                ->on('users_mahasiswa')
                ->cascadeOnDelete();

            $table->index('id_prestasi');
            $table->index('nim_mahasiswa');
            $table->index('status');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komentar');
    }
};
