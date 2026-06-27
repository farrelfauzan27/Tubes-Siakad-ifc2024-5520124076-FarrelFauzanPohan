<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    public function index(Request $request)
    {
        $query = MataKuliah::query();

        if ($search = $request->input('q')) {
            $query->where('nama_matakuliah', 'like', "%{$search}%")
                  ->orWhere('kode_matakuliah', 'like', "%{$search}%");
        }

        $matakuliahs = $query->orderBy('nama_matakuliah')->paginate(10)->withQueryString();

        return view('matakuliah.index', compact('matakuliahs'));
    }

    public function create()
    {
        return view('matakuliah.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_matakuliah' => ['required', 'string', 'max:8', 'unique:matakuliahs,kode_matakuliah'],
            'nama_matakuliah' => ['required', 'string', 'max:50'],
            'sks' => ['required', 'integer', 'min:1', 'max:6'],
        ]);

        MataKuliah::create($validated);

        return redirect()->route('matakuliah.index')->with('success', 'Data mata kuliah berhasil ditambahkan.');
    }

    public function edit(MataKuliah $matakuliah)
    {
        return view('matakuliah.edit', compact('matakuliah'));
    }

    public function update(Request $request, MataKuliah $matakuliah)
    {
        $validated = $request->validate([
            'nama_matakuliah' => ['required', 'string', 'max:50'],
            'sks' => ['required', 'integer', 'min:1', 'max:6'],
        ]);

        $matakuliah->update($validated);

        return redirect()->route('matakuliah.index')->with('success', 'Data mata kuliah berhasil diperbarui.');
    }

    public function destroy(MataKuliah $matakuliah)
    {
        $matakuliah->delete();

        return redirect()->route('matakuliah.index')->with('success', 'Data mata kuliah berhasil dihapus.');
    }
}
