@extends('layouts.app')
@section('title', 'Edit Mata Kuliah')
@section('content')
<h2 class="page-title">Edit Mata Kuliah</h2>
<div class="box box-form">
    <form method="POST" action="{{ route('matakuliah.update', $matakuliah->kode_matakuliah) }}">
        @csrf @method('PUT')
        <label>Kode Mata Kuliah</label>
        <input type="text" value="{{ $matakuliah->kode_matakuliah }}" disabled>

        <label>Nama Mata Kuliah</label>
        <input type="text" name="nama_matakuliah" value="{{ old('nama_matakuliah', $matakuliah->nama_matakuliah) }}">
        @error('nama_matakuliah') <div class="error-text">{{ $message }}</div> @enderror

        <label>SKS</label>
        <input type="number" name="sks" min="1" max="6" value="{{ old('sks', $matakuliah->sks) }}">
        @error('sks') <div class="error-text">{{ $message }}</div> @enderror

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('matakuliah.index') }}" class="btn">Batal</a>
    </form>
</div>
@endsection
