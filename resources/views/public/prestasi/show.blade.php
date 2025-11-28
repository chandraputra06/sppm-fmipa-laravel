@extends('layouts.public')

@section('content')

<h1 class="text-3xl font-bold mb-3">{{ $prestasi->judul_kegiatan }}</h1>

<p class="text-gray-600">
    Oleh: {{ $prestasi->nama_mahasiswa }} ({{ $prestasi->program_studi }})
</p>

<p class="mt-4">{{ $prestasi->deskripsi }}</p>

<hr class="my-6">

<h2 class="text-xl font-semibold mb-2">Komentar</h2>

@foreach($komentar as $k)
    <div class="p-3 border rounded bg-white shadow mb-2">
        <strong>{{ $k->mahasiswa->nama_mahasiswa }}</strong>
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

@endsection
