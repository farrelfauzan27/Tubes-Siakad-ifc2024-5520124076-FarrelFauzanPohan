@extends('layouts.app')
@section('title', 'Tambah Dosen')
@section('content')
<h2 class="page-title">Tambah Data Dosen</h2>
<div class="box box-form">
    <form method="POST" action="{{ route('dosen.store') }}">
        @csrf
        <label>NIDN (10 digit)</label>
        <input type="text" name="nidn" maxlength="10" value="{{ old('nidn') }}">
        @error('nidn') <div class="error-text">{{ $message }}</div> @enderror

        <label>Nama Dosen</label>
        <input type="text" name="nama" value="{{ old('nama') }}">
        @error('nama') <div class="error-text">{{ $message }}</div> @enderror

        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('dosen.index') }}" class="btn">Batal</a>
    </form>
</div>
@endsection
