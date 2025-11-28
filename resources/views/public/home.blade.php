@extends('layouts.public')

@section('content')
<div class="text-center mb-10">
    <h1 class="text-4xl font-bold mb-3">Prestasi Mahasiswa FMIPA</h1>
    <p class="text-gray-600 max-w-xl mx-auto">
        Sistem ini menampilkan daftar prestasi mahasiswa FMIPA Udayana. 
        Jelajahi prestasi yang telah dicapai dan berikan apresiasi.
    </p>

    <a href="/prestasi" class="mt-6 inline-block bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
        Lihat Prestasi
    </a>
</div>

<h2 class="text-xl font-semibold mb-3">Prestasi Terbaru</h2>

@if($latestPrestasi->count() == 0)
    <p>Belum ada data.</p>
@else
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach($latestPrestasi as $item)
            <div class="bg-white p-4 shadow rounded">
                <h3 class="font-semibold text-lg">{{ $item->judul_kegiatan }}</h3>
                <p class="text-sm text-gray-600">{{ $item->nama_mahasiswa }} • {{ $item->program_studi }}</p>

                <a href="{{ route('prestasi.show', $item->id_prestasi) }}" class="text-blue-600 hover:underline mt-2 inline-block">
                    Detail →
                </a>
            </div>
        @endforeach
    </div>
@endif
@endsection
