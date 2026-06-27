@extends('layouts.app')
@section('title', 'Tambah Jadwal')
@section('content')
<h2 class="page-title">Tambah Jadwal Kuliah</h2>
<div class="box box-form">
    <form method="POST" action="{{ route('jadwal.store') }}">
        @csrf
        <label>Mata Kuliah</label>
        <select name="kode_matakuliah">
            <option value="">-- Pilih Mata Kuliah --</option>
            @foreach($matakuliahs as $mk)
                <option value="{{ $mk->kode_matakuliah }}" {{ old('kode_matakuliah') == $mk->kode_matakuliah ? 'selected' : '' }}>{{ $mk->nama_matakuliah }}</option>
            @endforeach
        </select>
        @error('kode_matakuliah') <div class="error-text">{{ $message }}</div> @enderror

        <label>Dosen Pengajar</label>
        <select name="nidn">
            <option value="">-- Pilih Dosen --</option>
            @foreach($dosens as $d)
                <option value="{{ $d->nidn }}" {{ old('nidn') == $d->nidn ? 'selected' : '' }}>{{ $d->nama }}</option>
            @endforeach
        </select>
        @error('nidn') <div class="error-text">{{ $message }}</div> @enderror

        <label>Kelas</label>
        <input type="text" name="kelas" maxlength="1" value="{{ old('kelas') }}" placeholder="A / B / C">
        @error('kelas') <div class="error-text">{{ $message }}</div> @enderror

        <label>Hari</label>
        <select name="hari">
            <option value="">-- Pilih Hari --</option>
            @foreach($hariOptions as $hari)
                <option value="{{ $hari }}" {{ old('hari') == $hari ? 'selected' : '' }}>{{ $hari }}</option>
            @endforeach
        </select>
        @error('hari') <div class="error-text">{{ $message }}</div> @enderror

        <label>Jam</label>
        <input type="time" name="jam" value="{{ old('jam') }}">
        @error('jam') <div class="error-text">{{ $message }}</div> @enderror

        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('jadwal.index') }}" class="btn">Batal</a>
    </form>
</div>
@endsection
