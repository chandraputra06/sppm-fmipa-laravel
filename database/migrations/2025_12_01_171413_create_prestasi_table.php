<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prestasi', function (Blueprint $table) {
            $table->id('id_prestasi');

            $table->string('nim_mahasiswa', 20)->nullable(); // opsional dari Excel
            $table->string('nama_mahasiswa', 100);
            $table->string('program_studi', 50);
            $table->string('judul_kegiatan', 200);
            $table->enum('jenis_prestasi', ['Akademik', 'Non-Akademik']);
            $table->enum('tingkat', ['Lokal', 'Nasional', 'Internasional']);
            $table->date('tanggal_kegiatan');

            $table->string('file_bukti', 255)->nullable();
            $table->string('file_foto', 255)->nullable();
            $table->text('deskripsi')->nullable();

            $table->enum('status_publikasi', ['Draft', 'Diverifikasi', 'Dipublikasikan'])
                  ->default('Draft');

            $table->timestamps();

            $table->foreign('nim_mahasiswa')
                  ->references('nim')
                  ->on('users_mahasiswa')
                  ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prestasi');
    }
};
