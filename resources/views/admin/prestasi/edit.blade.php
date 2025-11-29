@extends('layouts.admin')

@section('content')

@if ($errors->any())
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="bg-white p-6 shadow rounded max-w-3xl">
    <h2 class="text-2xl font-bold mb-4">Review & Edit Prestasi</h2>

    <form action="{{ route('admin.prestasi.update', $prestasi->id_prestasi) }}" 
          method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- DATA MAHASISWA --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block font-semibold mb-1">NIM Mahasiswa</label>
                <input type="text" name="nim_mahasiswa"
                       value="{{ old('nim_mahasiswa', $prestasi->nim_mahasiswa) }}"
                       class="border p-2 rounded w-full">
            </div>

            <div>
                <label class="block font-semibold mb-1">Nama Mahasiswa</label>
                <input type="text" name="nama_mahasiswa"
                       value="{{ old('nama_mahasiswa', $prestasi->nama_mahasiswa) }}"
                       class="border p-2 rounded w-full" required>
            </div>

            <div>
                <label class="block font-semibold mb-1">Program Studi</label>
                <input type="text" name="program_studi"
                       value="{{ old('program_studi', $prestasi->program_studi) }}"
                       class="border p-2 rounded w-full" required>
            </div>
        </div>

        {{-- DATA PRESTASI --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">Judul Prestasi / Kegiatan</label>
            <input type="text" name="judul_kegiatan"
                   value="{{ old('judul_kegiatan', $prestasi->judul_kegiatan) }}"
                   class="border p-2 rounded w-full" required>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
            <div>
                <label class="block font-semibold mb-1">Jenis Prestasi</label>
                <select name="jenis_prestasi" class="border p-2 rounded w-full" required>
                    <option value="Akademik" {{ $prestasi->jenis_prestasi == 'Akademik' ? 'selected' : '' }}>Akademik</option>
                    <option value="Non-Akademik" {{ $prestasi->jenis_prestasi == 'Non-Akademik' ? 'selected' : '' }}>Non-Akademik</option>
                </select>
            </div>

            <div>
                <label class="block font-semibold mb-1">Tingkat</label>
                <select name="tingkat" class="border p-2 rounded w-full" required>
                    <option value="Lokal" {{ $prestasi->tingkat == 'Lokal' ? 'selected' : '' }}>Lokal</option>
                    <option value="Nasional" {{ $prestasi->tingkat == 'Nasional' ? 'selected' : '' }}>Nasional</option>
                    <option value="Internasional" {{ $prestasi->tingkat == 'Internasional' ? 'selected' : '' }}>Internasional</option>
                </select>
            </div>

            <div>
                <label class="block font-semibold mb-1">Tanggal Kegiatan</label>
                <input type="date" name="tanggal_kegiatan"
                       value="{{ old('tanggal_kegiatan', $prestasi->tanggal_kegiatan?->format('Y-m-d')) }}"
                       class="border p-2 rounded w-full" required>
            </div>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Deskripsi</label>
            <textarea name="deskripsi" rows="4"
                      class="border p-2 rounded w-full">{{ old('deskripsi', $prestasi->deskripsi) }}</textarea>
        </div>

        {{-- FILE FOTO & BUKTI --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block font-semibold mb-1">Foto Prestasi (opsional)</label>
                @if($prestasi->file_foto)
                    <div class="mb-2">
                        <img src="{{ asset('storage/'.$prestasi->file_foto) }}" 
                             alt="Foto Prestasi" class="w-40 rounded shadow">
                    </div>
                @endif
                <input type="file" name="file_foto" class="border p-2 rounded w-full">
            </div>

            <div>
                <label class="block font-semibold mb-1">File Bukti (PDF/JPG, opsional)</label>
                @if($prestasi->file_bukti)
                    <div class="mb-2">
                        <a href="{{ asset('storage/'.$prestasi->file_bukti) }}" target="_blank" 
                           class="text-blue-600 underline">Lihat Bukti Saat Ini</a>
                    </div>
                @endif
                <input type="file" name="file_bukti" class="border p-2 rounded w-full">
            </div>
        </div>

        {{-- STATUS --}}
        <div class="mb-6">
            <label class="block font-semibold mb-1">Status</label>
            <select name="status" class="border p-2 rounded w-full" required>
                <option value="Draft" {{ $prestasi->status == 'Draft' ? 'selected' : '' }}>Draft (belum tampil publik)</option>
                <option value="Dipublikasikan" {{ $prestasi->status == 'Dipublikasikan' ? 'selected' : '' }}>Published (tampil di publik)</option>
            </select>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.prestasi.index') }}" class="px-4 py-2 border rounded">
                Kembali
            </a>
            <button class="px-5 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>

@endsection
