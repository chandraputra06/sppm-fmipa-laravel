@extends('layouts.admin')

@section('content')

@if(session('success'))
<div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
@endif

@if(session('error'))
<div class="bg-red-100 text-red-700 p-3 rounded mb-4">{{ session('error') }}</div>
@endif

<div class="bg-white p-6 shadow rounded max-w-lg">

    <h2 class="text-xl font-bold mb-4">Import Data Prestasi</h2>

    <form action="{{ route('admin.import.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label class="block mb-2 font-medium">Upload File Excel:</label>
        <input type="file" name="file_excel" required class="border p-2 rounded w-full mb-4">

        <button class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 w-full">
            Upload & Import
        </button>
    </form>

    <a href="{{ asset('storage/templates/template_prestasi.xlsx') }}" class="text-blue-600 underline block mt-4">
        Download Template Excel
    </a>
</div>
@endsection
