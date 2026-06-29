<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Jadwal;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $query = Jadwal::with('mataKuliah', 'dosen');

        if ($search = $request->input('q')) {
            $query->whereHas('mataKuliah', function ($q) use ($search) {
                $q->where('nama_matakuliah', 'like', "%{$search}%");
            })->orWhereHas('dosen', function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%");
            });
        }

        $jadwals = $query->orderBy('hari')->paginate(10)->withQueryString();

        return view('jadwal.index', compact('jadwals'));
    }

    public function show(Jadwal $jadwal)
    {
        $jadwal->load('mataKuliah', 'dosen');
        return view('jadwal.show', compact('jadwal'));
    }

    public function create()
    {
        $matakuliahs = MataKuliah::orderBy('nama_matakuliah')->get();
        $dosens = Dosen::orderBy('nama')->get();
        $hariOptions = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        return view('jadwal.create', compact('matakuliahs', 'dosens', 'hariOptions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_matakuliah' => ['required', 'exists:matakuliahs,kode_matakuliah'],
            'nidn' => ['required', 'exists:dosens,nidn'],
            'kelas' => ['required', 'string', 'max:1'],
            'hari' => ['required', 'string', 'max:10'],
            'jam' => ['required'],
        ]);

        Jadwal::create($validated);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit(Jadwal $jadwal)
    {
        $matakuliahs = MataKuliah::orderBy('nama_matakuliah')->get();
        $dosens = Dosen::orderBy('nama')->get();
        $hariOptions = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        return view('jadwal.edit', compact('jadwal', 'matakuliahs', 'dosens', 'hariOptions'));
    }

    public function update(Request $request, Jadwal $jadwal)
    {
        $validated = $request->validate([
            'kode_matakuliah' => ['required', 'exists:matakuliahs,kode_matakuliah'],
            'nidn' => ['required', 'exists:dosens,nidn'],
            'kelas' => ['required', 'string', 'max:1'],
            'hari' => ['required', 'string', 'max:10'],
            'jam' => ['required'],
        ]);

        $jadwal->update($validated);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}
