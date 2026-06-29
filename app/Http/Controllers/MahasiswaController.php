<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Mahasiswa::with('dosen');

        if ($search = $request->input('q')) {
            $query->where('nama', 'like', "%{$search}%")
                  ->orWhere('npm', 'like', "%{$search}%");
        }

        $mahasiswas = $query->orderBy('nama')->paginate(10)->withQueryString();

        return view('mahasiswa.index', compact('mahasiswas'));
    }

    public function show(Mahasiswa $mahasiswa)
    {
        $mahasiswa->load('dosen', 'mataKuliahs', 'user');
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    public function create()
    {
        $dosens = Dosen::orderBy('nama')->get();
        return view('mahasiswa.create', compact('dosens'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'npm' => ['required', 'digits:10', 'unique:mahasiswas,npm'],
            'nama' => ['required', 'string', 'max:50'],
            'nidn' => ['nullable', 'exists:dosens,nidn'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6'],
        ]);

        Mahasiswa::create([
            'npm' => $validated['npm'],
            'nama' => $validated['nama'],
            'nidn' => $validated['nidn'] ?? null,
        ]);

        // Buat akun login otomatis untuk mahasiswa
        User::create([
            'name' => $validated['nama'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'mahasiswa',
            'npm' => $validated['npm'],
        ]);

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        $dosens = Dosen::orderBy('nama')->get();
        return view('mahasiswa.edit', compact('mahasiswa', 'dosens'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:50'],
            'nidn' => ['nullable', 'exists:dosens,nidn'],
        ]);

        $mahasiswa->update($validated);

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->user()->delete();
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}
