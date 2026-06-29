@extends('layouts.app')
@section('title', 'Data KRS')
@section('content')
<h2 class="page-title">Data KRS</h2>

<div class="top-actions">
    <form method="GET" class="search-bar">
        <input type="text" name="q" placeholder="Cari nama/NPM mahasiswa..." value="{{ request('q') }}">
        <button class="btn">Cari</button>
    </form>
    <div>
        <a href="{{ route('krs.create') }}" class="btn btn-primary">+ Tambah KRS</a>
        <a href="{{ route('krs.export.pdf') }}" class="btn">Export PDF</a>
        <a href="{{ route('krs.export.excel') }}" class="btn">Export Excel</a>
    </div>
</div>

<div class="box">
    <table>
        <thead><tr><th>NPM</th><th>Nama Mahasiswa</th><th>Mata Kuliah</th><th>SKS</th><th width="180">Aksi</th></tr></thead>
        <tbody>
            @forelse($krsList as $k)
                <tr>
                    <td>{{ $k->npm }}</td>
                    <td>{{ $k->mahasiswa->nama ?? '-' }}</td>
                    <td>{{ $k->mataKuliah->nama_matakuliah ?? '-' }}</td>
                    <td>{{ $k->mataKuliah->sks ?? '-' }}</td>
                    <td>
                        <a href="{{ route('krs.show', $k->id) }}" class="btn btn-sm">Detail</a>
                        <a href="{{ route('krs.edit', $k->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('krs.destroy', $k->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus data KRS ini?');">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">Belum ada data KRS</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $krsList->links() }}
</div>
@endsection
