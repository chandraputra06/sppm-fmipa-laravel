<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KomentarController extends Controller
{
    public function store(Request $request, $id)
    {
        // pastikan user sudah login (sebenarnya sudah dijaga middleware auth)
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // validasi isi komentar
        $request->validate([
            'isi_komentar' => ['required', 'string', 'min:3'],
        ]);

        // pastikan prestasi valid
        $prestasi = Prestasi::findOrFail($id);

        // simpan komentar baru
        Komentar::create([
            'id_prestasi'   => $prestasi->id_prestasi,
            'nim_mahasiswa' => Auth::user()->nim,
            'isi_komentar'  => $request->isi_komentar,
            'tanggal_komentar' => now(),
            'status'        => 'Tampil',
        ]);

        // balik ke halaman detail dengan pesan sukses
        return redirect()
            ->route('prestasi.show', $prestasi->id_prestasi)
            ->with('success', 'Komentar berhasil dikirim.');
    }
}
