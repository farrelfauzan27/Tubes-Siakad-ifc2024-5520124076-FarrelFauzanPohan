@extends('layouts.app')
@section('title', 'Detail Jadwal')
@section('content')
<h2 class="page-title">Detail Jadwal Kuliah</h2>

<div class="box" style="max-width:600px;">
    <table>
        <tr><th width="180">Mata Kuliah</th><td>{{ $jadwal->mataKuliah->nama_matakuliah ?? '-' }}</td></tr>
        <tr><th>Dosen Pengajar</th><td>{{ $jadwal->dosen->nama ?? '-' }}</td></tr>
        <tr><th>Kelas</th><td>{{ $jadwal->kelas }}</td></tr>
        <tr><th>Hari</th><td>{{ $jadwal->hari }}</td></tr>
        <tr><th>Jam</th><td>{{ $jadwal->jam }}</td></tr>
    </table>
</div>

<a href="{{ route('jadwal.index') }}" class="btn">Kembali</a>
@endsection
