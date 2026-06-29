@extends('layouts.app')
@section('title', 'Tambah KRS')
@section('content')
<h2 class="page-title">Tambah Data KRS</h2>

<div class="box box-form">
    <form method="POST" action="{{ route('krs.store.admin') }}">
        @csrf
        <label>Mahasiswa</label>
        <select name="npm">
            <option value="">-- Pilih Mahasiswa --</option>
            @foreach($mahasiswas as $m)
                <option value="{{ $m->npm }}" {{ old('npm') == $m->npm ? 'selected' : '' }}>{{ $m->nama }} ({{ $m->npm }})</option>
            @endforeach
        </select>
        @error('npm') <div class="error-text">{{ $message }}</div> @enderror

        <label>Mata Kuliah</label>
        <select name="kode_matakuliah">
            <option value="">-- Pilih Mata Kuliah --</option>
            @foreach($matakuliahs as $mk)
                <option value="{{ $mk->kode_matakuliah }}" {{ old('kode_matakuliah') == $mk->kode_matakuliah ? 'selected' : '' }}>{{ $mk->nama_matakuliah }} ({{ $mk->sks }} SKS)</option>
            @endforeach
        </select>
        @error('kode_matakuliah') <div class="error-text">{{ $message }}</div> @enderror

        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('krs.index') }}" class="btn">Batal</a>
    </form>
</div>
@endsection
