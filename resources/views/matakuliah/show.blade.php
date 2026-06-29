@extends('layouts.app')
@section('title', 'Detail Mata Kuliah')
@section('content')
<h2 class="page-title">Detail Mata Kuliah</h2>

<div class="box" style="max-width:600px;">
    <table>
        <tr><th width="180">Kode Mata Kuliah</th><td>{{ $matakuliah->kode_matakuliah }}</td></tr>
        <tr><th>Nama Mata Kuliah</th><td>{{ $matakuliah->nama_matakuliah }}</td></tr>
        <tr><th>SKS</th><td>{{ $matakuliah->sks }}</td></tr>
        <tr><th>Jumlah Mahasiswa Mengambil</th><td>{{ $matakuliah->mahasiswas->count() }}</td></tr>
    </table>
</div>

<div class="box">
    <h3 style="margin-top:0;">Jadwal Kelas</h3>
    <table>
        <thead><tr><th>Dosen</th><th>Kelas</th><th>Hari</th><th>Jam</th></tr></thead>
        <tbody>
            @forelse($matakuliah->jadwals as $j)
                <tr>
                    <td>{{ $j->dosen->nama ?? '-' }}</td>
                    <td>{{ $j->kelas }}</td>
                    <td>{{ $j->hari }}</td>
                    <td>{{ $j->jam }}</td>
                </tr>
            @empty
                <tr><td colspan="4">Belum ada jadwal</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="box">
    <h3 style="margin-top:0;">Mahasiswa Pengambil</h3>
    <table>
        <thead><tr><th>NPM</th><th>Nama</th></tr></thead>
        <tbody>
            @forelse($matakuliah->mahasiswas as $m)
                <tr><td>{{ $m->npm }}</td><td>{{ $m->nama }}</td></tr>
            @empty
                <tr><td colspan="2">Belum ada mahasiswa yang mengambil</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<a href="{{ route('matakuliah.index') }}" class="btn">Kembali</a>
@endsection
