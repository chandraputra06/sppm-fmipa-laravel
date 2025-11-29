<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\PrestasiImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function index()
    {
        return view('admin.import.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file_excel' => 'required|mimes:xlsx,xls'
        ]);

        try {
            Excel::import(new PrestasiImport, $request->file('file_excel'));
            return back()->with('success', 'Data berhasil diimport sebagai Draft.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Gagal mengimport: ' . $th->getMessage());
        }
    }
}
