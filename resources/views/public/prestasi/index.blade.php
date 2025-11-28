@extends('layouts.public')

@section('content')

<h1 class="text-2xl font-bold mb-4">Daftar Prestasi</h1>

<form method="GET" class="mb-4">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, NIM, atau prestasi..."
    class="border p-2 w-1/2 rounded">
    <button class="bg-blue-600 text-white px-4 py-2 rounded ml-2">Cari</button>
</form>

@if($prestasi->count() == 0)
    <p>Tidak ada data ditemukan.</p>
@else
    <ul class="space-y-3">
        @foreach($prestasi as $item)
            <li class="p-4 bg-white shadow rounded">
                <a href="{{ route('prestasi.show', $item->id_prestasi) }}" class="font-semibold text-blue-600">
                    {{ $item->judul_kegiatan }}
                </a>
                <p class="text-sm text-gray-600">{{ $item->nama_mahasiswa }} - {{ $item->tingkat }}</p>
            </li>
        @endforeach
    </ul>

    <div class="mt-4">
        {{ $prestasi->links() }}
    </div>
@endif

@endsection
