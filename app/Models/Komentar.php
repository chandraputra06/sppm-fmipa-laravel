<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Komentar extends Model
{
    protected $table = 'komentar';
    protected $primaryKey = 'id_komentar';
    public $timestamps = false; // karena kita pakai kolom tanggal_komentar sendiri

    protected $fillable = [
        'id_prestasi',
        'nim_mahasiswa',
        'isi_komentar',
        'tanggal_komentar',
        'status',
    ];

    public function prestasi(): BelongsTo
    {
        return $this->belongsTo(Prestasi::class, 'id_prestasi', 'id_prestasi');
    }

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class, 'nim_mahasiswa', 'nim');
    }
}