<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users_mahasiswa', function (Blueprint $table) {
            $table->string('nim', 20)->primary();
            $table->string('nama_mahasiswa', 100);
            $table->string('password');
            $table->string('program_studi', 50);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users_mahasiswa');
    }
};
