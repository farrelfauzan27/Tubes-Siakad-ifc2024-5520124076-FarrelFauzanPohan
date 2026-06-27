@extends('layouts.app')
@section('title', 'Edit Jadwal')
@section('content')
<h2 class="page-title">Edit Jadwal Kuliah</h2>
<div class="box box-form">
    <form method="POST" action="{{ route('jadwal.update', $jadwal->id) }}">
        @csrf @method('PUT')
        <label>Mata Kuliah</label>
        <select name="kode_matakuliah">
            @foreach($matakuliahs as $mk)
                <option value="{{ $mk->kode_matakuliah }}" {{ old('kode_matakuliah', $jadwal->kode_matakuliah) == $mk->kode_matakuliah ? 'selected' : '' }}>{{ $mk->nama_matakuliah }}</option>
            @endforeach
        </select>

        <label>Dosen Pengajar</label>
        <select name="nidn">
            @foreach($dosens as $d)
                <option value="{{ $d->nidn }}" {{ old('nidn', $jadwal->nidn) == $d->nidn ? 'selected' : '' }}>{{ $d->nama }}</option>
            @endforeach
        </select>

        <label>Kelas</label>
        <input type="text" name="kelas" maxlength="1" value="{{ old('kelas', $jadwal->kelas) }}">

        <label>Hari</label>
        <select name="hari">
            @foreach($hariOptions as $hari)
                <option value="{{ $hari }}" {{ old('hari', $jadwal->hari) == $hari ? 'selected' : '' }}>{{ $hari }}</option>
            @endforeach
        </select>

        <label>Jam</label>
        <input type="time" name="jam" value="{{ old('jam', \Carbon\Carbon::parse($jadwal->jam)->format('H:i')) }}">

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('jadwal.index') }}" class="btn">Batal</a>
    </form>
</div>
@endsection
