@extends('layouts.app')
@section('title', 'Dashboard Mahasiswa')
@section('content')
<h2 class="page-title">Dashboard Mahasiswa</h2>
<p>Selamat datang, {{ $mahasiswa->nama }}.</p>

<div class="stat-grid">
    <div class="stat-box">
        <div class="num">{{ $mahasiswa->npm }}</div>
        <div class="label">NPM</div>
    </div>
    <div class="stat-box">
        <div class="num">{{ $mahasiswa->dosen->nama ?? '-' }}</div>
        <div class="label">Dosen Wali</div>
    </div>
    <div class="stat-box">
        <div class="num">{{ $mahasiswa->mataKuliahs->sum('sks') }}</div>
        <div class="label">SKS Diambil</div>
    </div>
</div>

<div class="box">
    <h3 style="margin-top:0;">Jadwal Kuliah Anda</h3>
    <table>
        <thead><tr><th>Mata Kuliah</th><th>Dosen</th><th>Kelas</th><th>Hari</th><th>Jam</th></tr></thead>
        <tbody>
            @forelse($jadwalKuliah as $j)
                <tr>
                    <td>{{ $j->mataKuliah->nama_matakuliah }}</td>
                    <td>{{ $j->dosen->nama }}</td>
                    <td>{{ $j->kelas }}</td>
                    <td>{{ $j->hari }}</td>
                    <td>{{ $j->jam }}</td>
                </tr>
            @empty
                <tr><td colspan="5">Belum ada jadwal kuliah</td></tr>
            @endforelse
        </tbody>
    </table>
    <br>
    <a href="{{ route('krs.my') }}" class="btn btn-primary">Kelola KRS Saya</a>
</div>
@endsection
