<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KrsController extends Controller
{
    // Admin: lihat semua data KRS seluruh mahasiswa
    public function index(Request $request)
    {
        $query = Krs::with('mahasiswa', 'mataKuliah');

        if ($search = $request->input('q')) {
            $query->whereHas('mahasiswa', function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")->orWhere('npm', 'like', "%{$search}%");
            });
        }

        $krsList = $query->orderBy('npm')->paginate(10)->withQueryString();

        return view('krs.index', compact('krsList'));
    }

    // Admin: export seluruh data KRS ke PDF
    public function exportPdf()
    {
        $krsList = Krs::with('mahasiswa', 'mataKuliah')->orderBy('npm')->get();
        $pdf = Pdf::loadView('krs.export-pdf', compact('krsList'));

        return $pdf->download('data-krs-' . now()->format('Y-m-d') . '.pdf');
    }

    // Admin: export seluruh data KRS ke Excel (CSV)
    public function exportExcel()
    {
        $krsList = Krs::with('mahasiswa', 'mataKuliah')->orderBy('npm')->get();

        return $this->csvResponse(
            $krsList->map(fn ($k) => [
                $k->npm,
                $k->mahasiswa->nama ?? '-',
                $k->mataKuliah->kode_matakuliah ?? '-',
                $k->mataKuliah->nama_matakuliah ?? '-',
                $k->mataKuliah->sks ?? '-',
            ]),
            ['NPM', 'Nama Mahasiswa', 'Kode MK', 'Mata Kuliah', 'SKS'],
            'data-krs-' . now()->format('Y-m-d') . '.csv'
        );
    }

    // Admin: form tambah KRS untuk mahasiswa manapun
    public function create()
    {
        $mahasiswas = Mahasiswa::orderBy('nama')->get();
        $matakuliahs = MataKuliah::orderBy('nama_matakuliah')->get();
        return view('krs.create', compact('mahasiswas', 'matakuliahs'));
    }

    // Admin: simpan KRS baru untuk mahasiswa manapun
    public function storeAdmin(Request $request)
    {
        $validated = $request->validate([
            'npm' => ['required', 'exists:mahasiswas,npm'],
            'kode_matakuliah' => ['required', 'exists:matakuliahs,kode_matakuliah'],
        ]);

        $exists = Krs::where('npm', $validated['npm'])
            ->where('kode_matakuliah', $validated['kode_matakuliah'])
            ->exists();

        if ($exists) {
            return back()->with('error', 'Mahasiswa ini sudah mengambil mata kuliah tersebut.')->withInput();
        }

        Krs::create($validated);

        return redirect()->route('krs.index')->with('success', 'Data KRS berhasil ditambahkan.');
    }

    // Admin: lihat detail satu data KRS
    public function show(Krs $krs)
    {
        $krs->load('mahasiswa', 'mataKuliah');
        return view('krs.show', compact('krs'));
    }

    // Admin: form edit data KRS (ganti mata kuliah)
    public function edit(Krs $krs)
    {
        $matakuliahs = MataKuliah::orderBy('nama_matakuliah')->get();
        return view('krs.edit', compact('krs', 'matakuliahs'));
    }

    // Admin: update data KRS
    public function update(Request $request, Krs $krs)
    {
        $validated = $request->validate([
            'kode_matakuliah' => ['required', 'exists:matakuliahs,kode_matakuliah'],
        ]);

        $exists = Krs::where('npm', $krs->npm)
            ->where('kode_matakuliah', $validated['kode_matakuliah'])
            ->where('id', '!=', $krs->id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Mahasiswa ini sudah mengambil mata kuliah tersebut.');
        }

        $krs->update($validated);

        return redirect()->route('krs.index')->with('success', 'Data KRS berhasil diperbarui.');
    }

    // Mahasiswa: lihat KRS milik sendiri
    public function my()
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::with('mataKuliahs')->findOrFail($user->npm);
        $matakuliahTersedia = MataKuliah::orderBy('nama_matakuliah')->get();

        return view('krs.my', compact('mahasiswa', 'matakuliahTersedia'));
    }

    // Mahasiswa: export KRS sendiri ke PDF
    public function exportMyPdf()
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::with('mataKuliahs')->findOrFail($user->npm);
        $pdf = Pdf::loadView('krs.export-my-pdf', compact('mahasiswa'));

        return $pdf->download('krs-' . $mahasiswa->npm . '.pdf');
    }

    // Mahasiswa: export KRS sendiri ke Excel (CSV)
    public function exportMyExcel()
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::with('mataKuliahs')->findOrFail($user->npm);

        return $this->csvResponse(
            $mahasiswa->mataKuliahs->map(fn ($mk) => [
                $mk->kode_matakuliah,
                $mk->nama_matakuliah,
                $mk->sks,
            ]),
            ['Kode MK', 'Mata Kuliah', 'SKS'],
            'krs-' . $mahasiswa->npm . '.csv'
        );
    }

    private function csvResponse($rows, array $header, string $filename)
    {
        $callback = function () use ($rows, $header) {
            $handle = fopen('php://output', 'w');
            fputs($handle, "\xEF\xBB\xBF"); // BOM agar Excel baca UTF-8 dengan benar
            fputcsv($handle, $header);
            foreach ($rows as $row) {
                fputcsv($handle, $row);
            }
            fclose($handle);
        };

        return response()->stream($callback, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ]);
    }

    // Mahasiswa: ambil/input mata kuliah (KRS)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_matakuliah' => ['required', 'exists:matakuliahs,kode_matakuliah'],
        ]);

        $user = Auth::user();

        $exists = Krs::where('npm', $user->npm)
            ->where('kode_matakuliah', $validated['kode_matakuliah'])
            ->exists();

        if ($exists) {
            return back()->with('error', 'Mata kuliah ini sudah diambil sebelumnya.');
        }

        Krs::create([
            'npm' => $user->npm,
            'kode_matakuliah' => $validated['kode_matakuliah'],
        ]);

        return back()->with('success', 'Mata kuliah berhasil ditambahkan ke KRS.');
    }

    // Mahasiswa: drop / hapus mata kuliah dari KRS sendiri
    public function destroy(Krs $krs)
    {
        $user = Auth::user();

        if ($user->isMahasiswa() && $krs->npm !== $user->npm) {
            abort(403, 'Anda tidak dapat menghapus KRS mahasiswa lain.');
        }

        $krs->delete();

        return back()->with('success', 'Mata kuliah berhasil dihapus dari KRS.');
    }
}
