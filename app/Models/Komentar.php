<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    protected $table = 'komentar';
    protected $primaryKey = 'id_komentar';

    protected $fillable = [
        'id_prestasi',
        'nim_mahasiswa',
        'isi_komentar',
        'tanggal_komentar',
        'status',
    ];

    protected $casts = [
        'tanggal_komentar' => 'datetime',
    ];

    // Komentar milik satu prestasi
    public function prestasi()
    {
        return $this->belongsTo(Prestasi::class, 'id_prestasi', 'id_prestasi');
    }

    // Komentar ditulis oleh satu mahasiswa
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim_mahasiswa', 'nim');
    }
}
