@extends('layouts.app')
@section('title', 'Dashboard Admin')
@section('content')
<h2 class="page-title">Dashboard Admin</h2>
<p>Selamat datang, {{ auth()->user()->name }}.</p>

<div class="stat-grid">
    <div class="stat-box">
        <div class="num">{{ $stats['total_dosen'] }}</div>
        <div class="label">Dosen</div>
    </div>
    <div class="stat-box">
        <div class="num">{{ $stats['total_mahasiswa'] }}</div>
        <div class="label">Mahasiswa</div>
    </div>
    <div class="stat-box">
        <div class="num">{{ $stats['total_matakuliah'] }}</div>
        <div class="label">Mata Kuliah</div>
    </div>
    <div class="stat-box">
        <div class="num">{{ $stats['total_jadwal'] }}</div>
        <div class="label">Jadwal</div>
    </div>
    <div class="stat-box">
        <div class="num">{{ $stats['total_krs'] }}</div>
        <div class="label">Total KRS</div>
    </div>
</div>
@endsection
