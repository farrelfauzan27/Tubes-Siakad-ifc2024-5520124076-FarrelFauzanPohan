<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Jadwal;
use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            $stats = [
                'total_dosen' => Dosen::count(),
                'total_mahasiswa' => Mahasiswa::count(),
                'total_matakuliah' => MataKuliah::count(),
                'total_jadwal' => Jadwal::count(),
                'total_krs' => Krs::count(),
            ];

            return view('dashboard.admin', compact('stats'));
        }

        // Dashboard mahasiswa
        $mahasiswa = Mahasiswa::with('dosen', 'mataKuliahs')->find($user->npm);
        $jadwalKuliah = Jadwal::with('mataKuliah', 'dosen')
            ->whereIn('kode_matakuliah', $mahasiswa?->mataKuliahs->pluck('kode_matakuliah') ?? [])
            ->get();

        return view('dashboard.mahasiswa', compact('mahasiswa', 'jadwalKuliah'));
    }
}
