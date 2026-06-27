@extends('layouts.app')
@section('title', 'Tambah Mata Kuliah')
@section('content')
<h2 class="page-title">Tambah Mata Kuliah</h2>
<div class="box box-form">
    <form method="POST" action="{{ route('matakuliah.store') }}">
        @csrf
        <label>Kode Mata Kuliah (maks 8 karakter)</label>
        <input type="text" name="kode_matakuliah" maxlength="8" value="{{ old('kode_matakuliah') }}">
        @error('kode_matakuliah') <div class="error-text">{{ $message }}</div> @enderror

        <label>Nama Mata Kuliah</label>
        <input type="text" name="nama_matakuliah" value="{{ old('nama_matakuliah') }}">
        @error('nama_matakuliah') <div class="error-text">{{ $message }}</div> @enderror

        <label>SKS</label>
        <input type="number" name="sks" min="1" max="6" value="{{ old('sks') }}">
        @error('sks') <div class="error-text">{{ $message }}</div> @enderror

        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('matakuliah.index') }}" class="btn">Batal</a>
    </form>
</div>
@endsection
