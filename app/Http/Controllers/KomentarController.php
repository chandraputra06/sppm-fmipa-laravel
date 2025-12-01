<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use App\Models\Prestasi;
use Illuminate\Http\Request;

class KomentarController extends Controller
{
    public function store(Request $request, $idPrestasi)
    {
        $request->validate([
            'nim_mahasiswa' => 'required|string|max:20',
            'isi_komentar'  => 'required|string|min:3',
        ]);

        $prestasi = Prestasi::findOrFail($idPrestasi);

        $komentar = Komentar::create([
            'id_prestasi'   => $prestasi->id_prestasi,
            'nim_mahasiswa' => $request->nim_mahasiswa, // nanti diganti pakai Auth
            'isi_komentar'  => $request->isi_komentar,
            'status'        => 'Tampil',
        ]);

        return response()->json([
            'message'  => 'Komentar berhasil dibuat',
            'komentar' => $komentar,
        ]);
    }
}