@extends('layouts.app')
@section('title', 'Detail KRS')
@section('content')
<h2 class="page-title">Detail KRS</h2>

<div class="box" style="max-width:600px;">
    <table>
        <tr><th width="180">NPM</th><td>{{ $krs->npm }}</td></tr>
        <tr><th>Nama Mahasiswa</th><td>{{ $krs->mahasiswa->nama ?? '-' }}</td></tr>
        <tr><th>Kode Mata Kuliah</th><td>{{ $krs->mataKuliah->kode_matakuliah ?? '-' }}</td></tr>
        <tr><th>Nama Mata Kuliah</th><td>{{ $krs->mataKuliah->nama_matakuliah ?? '-' }}</td></tr>
        <tr><th>SKS</th><td>{{ $krs->mataKuliah->sks ?? '-' }}</td></tr>
        <tr><th>Tanggal Diambil</th><td>{{ $krs->created_at->format('d-m-Y H:i') }}</td></tr>
    </table>
</div>

<a href="{{ route('krs.edit', $krs->id) }}" class="btn btn-warning">Edit</a>
<a href="{{ route('krs.index') }}" class="btn">Kembali</a>
@endsection
