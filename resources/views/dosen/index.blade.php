@extends('layouts.app')
@section('title', 'Data Dosen')
@section('content')
<h2 class="page-title">Data Dosen</h2>

<div class="top-actions">
    <form method="GET" class="search-bar">
        <input type="text" name="q" placeholder="Cari nama/NIDN..." value="{{ request('q') }}">
        <button class="btn">Cari</button>
    </form>
    <a href="{{ route('dosen.create') }}" class="btn btn-primary">+ Tambah Dosen</a>
</div>

<div class="box">
    <table>
        <thead><tr><th>NIDN</th><th>Nama</th><th width="130">Aksi</th></tr></thead>
        <tbody>
            @forelse($dosens as $dosen)
                <tr>
                    <td>{{ $dosen->nidn }}</td>
                    <td>{{ $dosen->nama }}</td>
                    <td>
                        <a href="{{ route('dosen.edit', $dosen->nidn) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('dosen.destroy', $dosen->nidn) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus data dosen ini?');">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="3">Belum ada data dosen</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $dosens->links() }}
</div>
@endsection
