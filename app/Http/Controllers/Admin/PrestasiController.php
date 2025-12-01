<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    // GET /admin/prestasi
    public function index()
    {
        $prestasi = Prestasi::orderByDesc('created_at')->paginate(10);

        return response()->json($prestasi);
    }

    // POST /admin/prestasi
    public function store(Request $request)
    {
        $request->validate([
            'nim_mahasiswa'   => 'nullable|string|max:20',
            'nama_mahasiswa'  => 'required|string|max:100',
            'program_studi'   => 'required|string|max:50',
            'judul_kegiatan'  => 'required|string|max:200',
            'jenis_prestasi'  => 'required|in:Akademik,Non-Akademik',
            'tingkat'         => 'required|in:Lokal,Nasional,Internasional',
            'tanggal_kegiatan'=> 'required|date',
            'deskripsi'       => 'nullable|string',
            'file_bukti'      => 'nullable|file|mimes:pdf|max:2048',
            'file_foto'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only([
            'nim_mahasiswa',
            'nama_mahasiswa',
            'program_studi',
            'judul_kegiatan',
            'jenis_prestasi',
            'tingkat',
            'tanggal_kegiatan',
            'deskripsi',
        ]);

        if ($request->hasFile('file_bukti')) {
            $data['file_bukti'] = $request->file('file_bukti')->store('bukti', 'public');
        }

        if ($request->hasFile('file_foto')) {
            $data['file_foto'] = $request->file('file_foto')->store('foto', 'public');
        }

        $prestasi = Prestasi::create($data);

        return response()->json([
            'message'  => 'Prestasi berhasil dibuat',
            'data'     => $prestasi,
        ], 201);
    }

    // GET /admin/prestasi/{id}
    public function show($id)
    {
        $prestasi = Prestasi::findOrFail($id);

        return response()->json($prestasi);
    }

    // PUT /admin/prestasi/{id}
    public function update(Request $request, $id)
    {
        $prestasi = Prestasi::findOrFail($id);

        $request->validate([
            'nim_mahasiswa'   => 'nullable|string|max:20',
            'nama_mahasiswa'  => 'required|string|max:100',
            'program_studi'   => 'required|string|max:50',
            'judul_kegiatan'  => 'required|string|max:200',
            'jenis_prestasi'  => 'required|in:Akademik,Non-Akademik',
            'tingkat'         => 'required|in:Lokal,Nasional,Internasional',
            'tanggal_kegiatan'=> 'required|date',
            'deskripsi'       => 'nullable|string',
            'file_bukti'      => 'nullable|file|mimes:pdf|max:2048',
            'file_foto'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only([
            'nim_mahasiswa',
            'nama_mahasiswa',
            'program_studi',
            'judul_kegiatan',
            'jenis_prestasi',
            'tingkat',
            'tanggal_kegiatan',
            'deskripsi',
        ]);

        if ($request->hasFile('file_bukti')) {
            $data['file_bukti'] = $request->file('file_bukti')->store('bukti', 'public');
        }

        if ($request->hasFile('file_foto')) {
            $data['file_foto'] = $request->file('file_foto')->store('foto', 'public');
        }

        $prestasi->update($data);

        return response()->json([
            'message'  => 'Prestasi berhasil diperbarui',
            'data'     => $prestasi,
        ]);
    }

    // DELETE /admin/prestasi/{id}
    public function destroy($id)
    {
        $prestasi = Prestasi::findOrFail($id);
        $prestasi->delete();

        return response()->json([
            'message' => 'Prestasi berhasil dihapus',
        ]);
    }

    // POST /admin/prestasi/{id}/status
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_publikasi' => 'required|in:Draft,Diverifikasi,Dipublikasikan',
        ]);

        $prestasi = Prestasi::findOrFail($id);
        $prestasi->status_publikasi = $request->status_publikasi;
        $prestasi->save();

        return response()->json([
            'message' => 'Status publikasi berhasil diperbarui',
            'data'    => $prestasi,
        ]);
    }
}