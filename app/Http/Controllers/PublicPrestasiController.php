<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Illuminate\Http\Request;

class PublicPrestasiController extends Controller
{
    public function home()
    {
        $latestPrestasi = Prestasi::where('status', 'Dipublikasikan')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('public.home', compact('latestPrestasi'));
    }

    public function index(Request $request)
    {
        $query = Prestasi::where('status', 'Dipublikasikan');

        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('nama_mahasiswa', 'like', "%{$request->search}%")
                  ->orWhere('nim_mahasiswa', 'like', "%{$request->search}%")
                  ->orWhere('judul_kegiatan', 'like', "%{$request->search}%");
            });
        }

        $prestasi = $query->orderBy('tanggal_kegiatan', 'desc')->paginate(10)->withQueryString();

        return view('public.prestasi.index', compact('prestasi'));
    }

    public function show($id)
    {
        $prestasi = Prestasi::findOrFail($id);
        $komentar = $prestasi->komentar()->with('mahasiswa')->orderBy('created_at', 'desc')->get();

        return view('public.prestasi.show', compact('prestasi', 'komentar'));
    }
}
