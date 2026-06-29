@extends('layouts.app')
@section('title', 'Detail Dosen')
@section('content')
<h2 class="page-title">Detail Dosen</h2>

<div class="box" style="max-width:600px;">
    <table>
        <tr><th width="180">NIDN</th><td>{{ $dosen->nidn }}</td></tr>
        <tr><th>Nama</th><td>{{ $dosen->nama }}</td></tr>
        <tr><th>Jumlah Mahasiswa Bimbingan</th><td>{{ $dosen->mahasiswas->count() }}</td></tr>
        <tr><th>Jumlah Kelas Diajar</th><td>{{ $dosen->jadwals->count() }}</td></tr>
    </table>
</div>

<div class="box">
    <h3 style="margin-top:0;">Mahasiswa Bimbingan</h3>
    <table>
        <thead><tr><th>NPM</th><th>Nama</th></tr></thead>
        <tbody>
            @forelse($dosen->mahasiswas as $m)
                <tr><td>{{ $m->npm }}</td><td>{{ $m->nama }}</td></tr>
            @empty
                <tr><td colspan="2">Belum ada mahasiswa bimbingan</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="box">
    <h3 style="margin-top:0;">Jadwal Mengajar</h3>
    <table>
        <thead><tr><th>Mata Kuliah</th><th>Kelas</th><th>Hari</th><th>Jam</th></tr></thead>
        <tbody>
            @forelse($dosen->jadwals as $j)
                <tr>
                    <td>{{ $j->mataKuliah->nama_matakuliah ?? '-' }}</td>
                    <td>{{ $j->kelas }}</td>
                    <td>{{ $j->hari }}</td>
                    <td>{{ $j->jam }}</td>
                </tr>
            @empty
                <tr><td colspan="4">Belum ada jadwal mengajar</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<a href="{{ route('dosen.index') }}" class="btn">Kembali</a>
@endsection
