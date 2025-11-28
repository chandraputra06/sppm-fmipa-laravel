<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Mahasiswa extends Authenticatable
{
    use Notifiable;

    protected $table = 'users_mahasiswa';
    protected $primaryKey = 'nim';
    public $incrementing = false;       // karena PK string
    protected $keyType = 'string';

    protected $fillable = [
        'nim',
        'nama_mahasiswa',
        'password',
        'program_studi',
    ];

    protected $hidden = [
        'password',
    ];

    // Relasi: satu mahasiswa bisa punya banyak komentar
    public function komentar()
    {
        return $this->hasMany(Komentar::class, 'nim_mahasiswa', 'nim');
    }

    // Relasi opsional: satu mahasiswa bisa punya banyak prestasi
    public function prestasi()
    {
        return $this->hasMany(Prestasi::class, 'nim_mahasiswa', 'nim');
    }
}
