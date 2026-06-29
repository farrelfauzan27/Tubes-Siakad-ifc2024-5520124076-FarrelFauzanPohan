@extends('layouts.app')
@section('title', 'Data Mahasiswa')
@section('content')
<h2 class="page-title">Data Mahasiswa</h2>

<div class="top-actions">
    <form method="GET" class="search-bar">
        <input type="text" name="q" placeholder="Cari nama/NPM..." value="{{ request('q') }}">
        <button class="btn">Cari</button>
    </form>
    <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary">+ Tambah Mahasiswa</a>
</div>

<div class="box">
    <table>
        <thead><tr><th>NPM</th><th>Nama</th><th>Dosen Wali</th><th width="130">Aksi</th></tr></thead>
        <tbody>
            @forelse($mahasiswas as $m)
                <tr>
                    <td>{{ $m->npm }}</td>
                    <td>{{ $m->nama }}</td>
                    <td>{{ $m->dosen->nama ?? '-' }}</td>
                    <td>
                        <a href="{{ route('mahasiswa.show', $m->npm) }}" class="btn btn-sm">Detail</a>
                        <a href="{{ route('mahasiswa.edit', $m->npm) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('mahasiswa.destroy', $m->npm) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus data mahasiswa ini?');">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">Belum ada data mahasiswa</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $mahasiswas->links() }}
</div>
@endsection
