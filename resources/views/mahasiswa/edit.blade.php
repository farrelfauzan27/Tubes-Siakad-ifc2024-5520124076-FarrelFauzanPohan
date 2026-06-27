@extends('layouts.app')
@section('title', 'Edit Mahasiswa')
@section('content')
<h2 class="page-title">Edit Data Mahasiswa</h2>
<div class="box box-form">
    <form method="POST" action="{{ route('mahasiswa.update', $mahasiswa->npm) }}">
        @csrf @method('PUT')
        <label>NPM</label>
        <input type="text" value="{{ $mahasiswa->npm }}" disabled>

        <label>Nama Mahasiswa</label>
        <input type="text" name="nama" value="{{ old('nama', $mahasiswa->nama) }}">
        @error('nama') <div class="error-text">{{ $message }}</div> @enderror

        <label>Dosen Wali</label>
        <select name="nidn">
            <option value="">-- Pilih Dosen Wali --</option>
            @foreach($dosens as $d)
                <option value="{{ $d->nidn }}" {{ old('nidn', $mahasiswa->nidn) == $d->nidn ? 'selected' : '' }}>{{ $d->nama }}</option>
            @endforeach
        </select>
        @error('nidn') <div class="error-text">{{ $message }}</div> @enderror

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('mahasiswa.index') }}" class="btn">Batal</a>
    </form>
</div>
@endsection
