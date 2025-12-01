<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    // List prestasi yang sudah dipublikasikan
    public function index(Request $request)
    {
        $query = Prestasi::query()
            ->where('status_publikasi', 'Dipublikasikan')
            ->orderByDesc('tanggal_kegiatan');

        // filter kata kunci (opsional)
        if ($search = $request->input('q')) {
            $query->where(function ($q2) use ($search) {
                $q2->where('judul_kegiatan', 'like', "%{$search}%")
                   ->orWhere('nama_mahasiswa', 'like', "%{$search}%");
            });
        }

        // filter prodi (opsional)
        if ($prodi = $request->input('prodi')) {
            $query->where('program_studi', $prodi);
        }

        $prestasi = $query->paginate(12);

        // sementara: return JSON dulu biar gampang cek
        return response()->json($prestasi);
    }

    // Detail satu prestasi + komentar
    public function show($id)
    {
        $prestasi = Prestasi::with(['komentar.mahasiswa'])->findOrFail($id);

        // sementara: return JSON juga
        return response()->json($prestasi);
    }
}
