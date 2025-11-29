@extends('layouts.public')

@section('content')

<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">

    <h1 class="text-3xl font-bold mb-3">{{ $prestasi->judul_kegiatan }}</h1>

    <p class="text-gray-600 text-lg">
        {{ $prestasi->nama_mahasiswa }} ({{ $prestasi->program_studi }})
    </p>

    <p class="text-sm text-gray-500 mb-4">
        Tingkat: {{ $prestasi->tingkat }} | 
        Tanggal: {{ \Carbon\Carbon::parse($prestasi->tanggal_kegiatan)->format('d M Y') }}
    </p>

    {{-- Foto Prestasi --}}
    @if($prestasi->file_foto)
        <img src="{{ asset('storage/'.$prestasi->file_foto) }}" 
             class="w-full rounded mb-4 shadow">
    @endif

    {{-- Deskripsi --}}
    <h2 class="text-xl font-semibold mb-2">Deskripsi</h2>
    <p class="mb-4 leading-relaxed">{{ $prestasi->deskripsi ?: '-' }}</p>

    {{-- File Bukti --}}
    @if($prestasi->file_bukti)
        <a href="{{ asset('storage/'.$prestasi->file_bukti) }}" target="_blank"
            class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 inline-block mb-6">
            Lihat File Bukti (PDF/JPG)
        </a>
    @else
        <p class="text-gray-400 italic mb-6">Belum ada file bukti</p>
    @endif

    <hr class="my-6">

    {{-- Komentar --}}
    <h2 class="text-xl font-semibold mb-2">Komentar</h2>

    @foreach($komentar as $k)
        <div class="p-3 border rounded bg-white shadow mb-2">
            <strong>{{ optional($k->mahasiswa)->nama_mahasiswa ?? 'Mahasiswa' }}</strong>
            <p>{{ $k->isi_komentar }}</p>
        </div>
    @endforeach

    @auth
    <form method="POST" action="{{ route('prestasi.komentar.store', $prestasi->id_prestasi) }}" class="mt-4">
        @csrf
        <textarea name="isi_komentar" class="w-full border p-2 rounded" placeholder="Tulis komentar..." required></textarea>
        <button class="mt-2 bg-blue-600 text-white px-4 py-2 rounded">Kirim</button>
    </form>
    @else
        <p class="text-gray-500 italic mt-2">Login untuk memberi komentar.</p>
    @endauth

</div>

@endsection
