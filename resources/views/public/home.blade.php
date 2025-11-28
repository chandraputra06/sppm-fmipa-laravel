@extends('layouts.public')

@section('content')
<h1 class="text-2xl font-bold mb-4">Prestasi Terbaru</h1>

@if($latestPrestasi->count() == 0)
    <p>Belum ada data prestasi.</p>
@else
    <ul class="space-y-3">
        @foreach($latestPrestasi as $item)
            <li class="p-4 bg-white shadow rounded">
                <a href="{{ route('prestasi.show', $item->id_prestasi) }}" class="font-semibold text-blue-600">
                    {{ $item->judul_kegiatan }}
                </a>
                <p class="text-sm text-gray-600">{{ $item->nama_mahasiswa }} - {{ $item->program_studi }}</p>
            </li>
        @endforeach
    </ul>
@endif
@endsection
