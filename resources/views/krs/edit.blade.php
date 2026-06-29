@extends('layouts.app')
@section('title', 'Edit KRS')
@section('content')
<h2 class="page-title">Edit Data KRS</h2>

<div class="box box-form">
    <p><strong>NPM:</strong> {{ $krs->npm }}<br>
       <strong>Nama:</strong> {{ $krs->mahasiswa->nama ?? '-' }}</p>

    <form method="POST" action="{{ route('krs.update', $krs->id) }}">
        @csrf @method('PUT')
        <label>Mata Kuliah</label>
        <select name="kode_matakuliah">
            @foreach($matakuliahs as $mk)
                <option value="{{ $mk->kode_matakuliah }}" {{ old('kode_matakuliah', $krs->kode_matakuliah) == $mk->kode_matakuliah ? 'selected' : '' }}>{{ $mk->nama_matakuliah }} ({{ $mk->sks }} SKS)</option>
            @endforeach
        </select>
        @error('kode_matakuliah') <div class="error-text">{{ $message }}</div> @enderror

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('krs.index') }}" class="btn">Batal</a>
    </form>
</div>
@endsection
