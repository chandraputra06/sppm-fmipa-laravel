@extends('layouts.admin')

@section('content')

<div class="flex justify-between mb-5">
    <h1 class="text-2xl font-bold">Data Prestasi</h1>
</div>

<!-- Filter & Search -->
<form class="flex gap-3 mb-5" method="GET">
    <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama, NIM, atau prestasi..." 
           class="border p-2 w-1/2 rounded">

    <select name="status" class="border p-2 rounded">
        <option value="all">Semua Status</option>
        <option value="Draft" {{ $status == 'Draft' ? 'selected' : '' }}>Draft</option>
        <option value="Published" {{ $status == 'Published' ? 'selected' : '' }}>Published</option>
    </select>

    <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Filter
    </button>
</form>

<!-- Tabel -->
<div class="overflow-x-auto bg-white shadow-md rounded-lg">
<table class="min-w-full text-sm text-left">
    <thead class="bg-gray-200 font-semibold">
        <tr>
            <th class="p-3">Nama</th>
            <th class="p-3">NIM</th>
            <th class="p-3">Prestasi</th>
            <th class="p-3">Tingkat</th>
            <th class="p-3">Status</th>
            <th class="p-3">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($prestasi as $item)
        <tr class="border-b hover:bg-gray-50">
            <td class="p-3">{{ $item->nama_mahasiswa }}</td>
            <td class="p-3">{{ $item->nim_mahasiswa ?? '-' }}</td>
            <td class="p-3">{{ $item->judul_kegiatan }}</td>
            <td class="p-3">{{ $item->tingkat }}</td>
            <td class="p-3">
                <span class="px-3 py-1 rounded text-white
                    {{ $item->status == 'Published' ? 'bg-green-600' : 'bg-gray-500' }}">
                    {{ $item->status }}
                </span>
            </td>
            <td class="p-3">
                <a href="{{ route('admin.prestasi.edit', $item->id_prestasi) }}" 
                   class="text-blue-600 hover:underline">Review</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

<div class="mt-5">
    {{ $prestasi->links() }}
</div>

@endsection
