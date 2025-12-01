<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users_admin', function (Blueprint $table) {
            $table->id('id_admin');
            $table->string('username', 50)->unique();
            $table->string('password');
            $table->string('nama_lengkap', 100);
            $table->enum('role', ['Superadmin', 'Operator'])->default('Operator');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users_admin');
    }
};
