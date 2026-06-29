@extends('layouts.app')
@section('title', 'Data Mata Kuliah')
@section('content')
<h2 class="page-title">Data Mata Kuliah</h2>

<div class="top-actions">
    <form method="GET" class="search-bar">
        <input type="text" name="q" placeholder="Cari nama/kode..." value="{{ request('q') }}">
        <button class="btn">Cari</button>
    </form>
    <a href="{{ route('matakuliah.create') }}" class="btn btn-primary">+ Tambah Mata Kuliah</a>
</div>

<div class="box">
    <table>
        <thead><tr><th>Kode</th><th>Nama Mata Kuliah</th><th>SKS</th><th width="130">Aksi</th></tr></thead>
        <tbody>
            @forelse($matakuliahs as $mk)
                <tr>
                    <td>{{ $mk->kode_matakuliah }}</td>
                    <td>{{ $mk->nama_matakuliah }}</td>
                    <td>{{ $mk->sks }}</td>
                    <td>
                        <a href="{{ route('matakuliah.show', $mk->kode_matakuliah) }}" class="btn btn-sm">Detail</a>
                        <a href="{{ route('matakuliah.edit', $mk->kode_matakuliah) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('matakuliah.destroy', $mk->kode_matakuliah) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus mata kuliah ini?');">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">Belum ada data mata kuliah</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $matakuliahs->links() }}
</div>
@endsection
