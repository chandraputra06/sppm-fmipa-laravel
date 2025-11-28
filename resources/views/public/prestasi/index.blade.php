@extends('layouts.public')

@section('content')
<h1 class="text-3xl font-bold mb-6">Daftar Prestasi</h1>

<form method="GET" class="mb-5 flex gap-2">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, NIM, atau judul prestasi..." 
        class="border w-full p-2 rounded">

    <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Cari
    </button>
</form>

@if($prestasi->count() == 0)
    <p class="text-gray-600">Tidak ada data ditemukan.</p>
@else

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    @foreach($prestasi as $item)
        <div class="bg-white shadow p-4 rounded">
            <h3 class="font-semibold text-lg">{{ $item->judul_kegiatan }}</h3>
            <p class="text-gray-600">{{ $item->nama_mahasiswa }} - {{ $item->tingkat }}</p>
            <a href="{{ route('prestasi.show', $item->id_prestasi) }}" class="text-blue-600 hover:underline mt-2 inline-block">
                Detail →
            </a>
        </div>
    @endforeach
</div>

<div class="mt-6">
    {{ $prestasi->links() }}
</div>

@endif
@endsection
