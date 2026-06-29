@extends('layouts.app')
@section('title', 'Detail Mahasiswa')
@section('content')
<h2 class="page-title">Detail Mahasiswa</h2>

<div class="box" style="max-width:600px;">
    <table>
        <tr><th width="180">NPM</th><td>{{ $mahasiswa->npm }}</td></tr>
        <tr><th>Nama</th><td>{{ $mahasiswa->nama }}</td></tr>
        <tr><th>Dosen Wali</th><td>{{ $mahasiswa->dosen->nama ?? '-' }}</td></tr>
        <tr><th>Email Akun</th><td>{{ $mahasiswa->user->email ?? '-' }}</td></tr>
        <tr><th>Total SKS Diambil</th><td>{{ $mahasiswa->mataKuliahs->sum('sks') }}</td></tr>
    </table>
</div>

<div class="box">
    <h3 style="margin-top:0;">Mata Kuliah yang Diambil (KRS)</h3>
    <table>
        <thead><tr><th>Kode</th><th>Mata Kuliah</th><th>SKS</th></tr></thead>
        <tbody>
            @forelse($mahasiswa->mataKuliahs as $mk)
                <tr><td>{{ $mk->kode_matakuliah }}</td><td>{{ $mk->nama_matakuliah }}</td><td>{{ $mk->sks }}</td></tr>
            @empty
                <tr><td colspan="3">Belum mengambil mata kuliah apapun</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<a href="{{ route('mahasiswa.index') }}" class="btn">Kembali</a>
@endsection
