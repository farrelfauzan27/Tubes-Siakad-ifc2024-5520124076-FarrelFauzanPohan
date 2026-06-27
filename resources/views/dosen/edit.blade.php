@extends('layouts.app')
@section('title', 'Edit Dosen')
@section('content')
<h2 class="page-title">Edit Data Dosen</h2>
<div class="box box-form">
    <form method="POST" action="{{ route('dosen.update', $dosen->nidn) }}">
        @csrf @method('PUT')
        <label>NIDN</label>
        <input type="text" value="{{ $dosen->nidn }}" disabled>

        <label>Nama Dosen</label>
        <input type="text" name="nama" value="{{ old('nama', $dosen->nama) }}">
        @error('nama') <div class="error-text">{{ $message }}</div> @enderror

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('dosen.index') }}" class="btn">Batal</a>
    </form>
</div>
@endsection
