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
        Schema::create('prestasi', function (Blueprint $table) {
            $table->id('id_prestasi');

            // data mahasiswa (bisa di-link ke tabel users_mahasiswa, tapi opsional)
            $table->string('nim_mahasiswa', 20)->nullable();
            $table->string('nama_mahasiswa', 100);
            $table->string('program_studi', 50);

            // informasi prestasi
            $table->string('judul_kegiatan', 200);
            $table->enum('jenis_prestasi', ['Akademik', 'Non-Akademik']);
            $table->enum('tingkat', ['Lokal', 'Nasional', 'Internasional']);
            $table->date('tanggal_kegiatan');

            // file bukti & foto (simpan path, bukan file binary)
            $table->string('file_bukti', 255)->nullable();
            $table->string('file_foto', 255)->nullable();

            $table->text('deskripsi')->nullable();

            // status publikasi (bisa kamu sesuaikan nilai enum-nya)
            $table->enum('status', ['Draft', 'Diverifikasi', 'Dipublikasikan'])
                ->default('Draft');

            $table->timestamps();

            // index untuk percepat pencarian/filter
            $table->index('nim_mahasiswa');
            $table->index('nama_mahasiswa');
            $table->index('program_studi');
            $table->index('jenis_prestasi');
            $table->index('tingkat');
            $table->index('tanggal_kegiatan');
            $table->index('status');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestasi');
    }
};
