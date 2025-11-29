<?php

namespace App\Imports;

use App\Models\Prestasi;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PrestasiImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Prestasi([
            'nim_mahasiswa'    => $row['nim_mahasiswa'] ?? null,
            'nama_mahasiswa'   => $row['nama_mahasiswa'],
            'program_studi'    => $row['program_studi'],
            'judul_kegiatan'   => $row['judul_prestasi'],
            'jenis_prestasi'   => $row['jenis'],
            'tingkat'          => $row['tingkat'],
            'tanggal_kegiatan' => Carbon::parse($row['tanggal']),
            'deskripsi'        => $row['deskripsi'] ?? null,
            'file_foto'        => null,
            'file_bukti'       => null,
            'status'           => 'Draft',
        ]);
    }
}
