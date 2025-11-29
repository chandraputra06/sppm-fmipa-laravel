<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PrestasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $status = $request->status;

        $query = Prestasi::query();

        // Filter search
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_mahasiswa', 'like', "%$search%")
                ->orWhere('nim_mahasiswa', 'like', "%$search%")
                ->orWhere('judul_kegiatan', 'like', "%$search%");
            });
        }

        // Filter status
        if ($status && $status !== 'all') {
            $query->where('status', $status);
        }

        $prestasi = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        return view('admin.prestasi.index', compact('prestasi', 'search', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Prestasi $prestasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prestasi $prestasi)
    {
        return view('admin.prestasi.edit', compact('prestasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prestasi $prestasi)
    {
        $validated = $request->validate([
            'nim_mahasiswa'   => 'nullable|string|max:20',
            'nama_mahasiswa'  => 'required|string|max:100',
            'program_studi'   => 'required|string|max:50',
            'judul_kegiatan'  => 'required|string|max:200',
            'jenis_prestasi'  => 'required|in:Akademik,Non-Akademik',
            'tingkat'         => 'required|in:Lokal,Nasional,Internasional',
            'tanggal_kegiatan'=> 'required|date',
            'deskripsi'       => 'nullable|string',
            'status'          => 'required|in:Draft,Dipublikasikan',

            'file_foto'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'file_bukti'      => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:4096',
        ]);

        // Handle foto
        if ($request->hasFile('file_foto')) {
            if ($prestasi->file_foto) {
                Storage::disk('public')->delete($prestasi->file_foto);
            }

            $pathFoto = $request->file('file_foto')->store('prestasi/foto', 'public');
            $validated['file_foto'] = $pathFoto;
        }

        // Handle file bukti
        if ($request->hasFile('file_bukti')) {
            if ($prestasi->file_bukti) {
                Storage::disk('public')->delete($prestasi->file_bukti);
            }

            $pathBukti = $request->file('file_bukti')->store('prestasi/bukti', 'public');
            $validated['file_bukti'] = $pathBukti;
        }

        $prestasi->update($validated);

        return redirect()
            ->route('admin.prestasi.index')
            ->with('success', 'Data prestasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prestasi $prestasi)
    {
        //
    }
}
