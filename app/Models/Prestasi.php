<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    protected $table = 'prestasi';
    protected $primaryKey = 'id_prestasi';

    protected $fillable = [
        'nim_mahasiswa',
        'nama_mahasiswa',
        'program_studi',
        'judul_kegiatan',
        'jenis_prestasi',
        'tingkat',
        'tanggal_kegiatan',
        'file_bukti',
        'file_foto',
        'deskripsi',
        'status',
    ];

    protected $casts = [
        'tanggal_kegiatan' => 'date',
    ];

    // Prestasi milik satu mahasiswa (opsional)
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim_mahasiswa', 'nim');
    }

    // Prestasi punya banyak komentar
    public function komentar()
    {
        return $this->hasMany(Komentar::class, 'id_prestasi', 'id_prestasi');
    }
}
