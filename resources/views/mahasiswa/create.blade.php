@extends('layouts.app')
@section('title', 'Tambah Mahasiswa')
@section('content')
<h2 class="page-title">Tambah Data Mahasiswa</h2>
<div class="box box-form">
    <form method="POST" action="{{ route('mahasiswa.store') }}">
        @csrf
        <label>NPM (10 digit)</label>
        <input type="text" name="npm" maxlength="10" value="{{ old('npm') }}">
        @error('npm') <div class="error-text">{{ $message }}</div> @enderror

        <label>Nama Mahasiswa</label>
        <input type="text" name="nama" value="{{ old('nama') }}">
        @error('nama') <div class="error-text">{{ $message }}</div> @enderror

        <label>Dosen Wali</label>
        <select name="nidn">
            <option value="">-- Pilih Dosen Wali --</option>
            @foreach($dosens as $d)
                <option value="{{ $d->nidn }}" {{ old('nidn') == $d->nidn ? 'selected' : '' }}>{{ $d->nama }}</option>
            @endforeach
        </select>
        @error('nidn') <div class="error-text">{{ $message }}</div> @enderror

        <hr>
        <p class="text-muted">Akun login mahasiswa:</p>

        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}">
        @error('email') <div class="error-text">{{ $message }}</div> @enderror

        <label>Password</label>
        <input type="password" name="password">
        @error('password') <div class="error-text">{{ $message }}</div> @enderror

        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('mahasiswa.index') }}" class="btn">Batal</a>
    </form>
</div>
@endsection
