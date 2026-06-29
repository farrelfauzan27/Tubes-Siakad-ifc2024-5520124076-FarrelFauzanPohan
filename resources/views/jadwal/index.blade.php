@extends('layouts.app')
@section('title', 'Jadwal Kuliah')
@section('content')
<h2 class="page-title">Jadwal Kuliah</h2>

<div class="top-actions">
    <form method="GET" class="search-bar">
        <input type="text" name="q" placeholder="Cari mata kuliah/dosen..." value="{{ request('q') }}">
        <button class="btn">Cari</button>
    </form>
    <a href="{{ route('jadwal.create') }}" class="btn btn-primary">+ Tambah Jadwal</a>
</div>

<div class="box">
    <table>
        <thead><tr><th>Mata Kuliah</th><th>Dosen</th><th>Kelas</th><th>Hari</th><th>Jam</th><th width="130">Aksi</th></tr></thead>
        <tbody>
            @forelse($jadwals as $j)
                <tr>
                    <td>{{ $j->mataKuliah->nama_matakuliah }}</td>
                    <td>{{ $j->dosen->nama }}</td>
                    <td>{{ $j->kelas }}</td>
                    <td>{{ $j->hari }}</td>
                    <td>{{ $j->jam }}</td>
                    <td>
                        <a href="{{ route('jadwal.show', $j->id) }}" class="btn btn-sm">Detail</a>
                        <a href="{{ route('jadwal.edit', $j->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('jadwal.destroy', $j->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus jadwal ini?');">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6">Belum ada jadwal</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $jadwals->links() }}
</div>
@endsection
