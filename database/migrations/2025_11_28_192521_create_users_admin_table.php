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
        Schema::create('users_admin', function (Blueprint $table) {
            $table->id('id_admin');                    // PK auto increment
            $table->string('username', 50)->unique();  // untuk login
            $table->string('password', 255);           // simpan hash
            $table->string('nama_lengkap', 100);
            $table->enum('role', ['Superadmin', 'Operator'])->default('Operator');
            $table->timestamps();                      // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_admin');
    }
};
