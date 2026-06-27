@extends('layouts.app')
@section('title', 'KRS Saya')
@section('content')
<h2 class="page-title">KRS Saya</h2>

<div style="display:flex; gap:20px; flex-wrap:wrap;">
    <div class="box" style="flex:1; min-width:320px;">
        <h3 style="margin-top:0;">Mata Kuliah yang Sudah Diambil</h3>
        <div style="margin-bottom:10px;">
            <a href="{{ route('krs.my.export.pdf') }}" class="btn btn-sm">Export PDF</a>
            <a href="{{ route('krs.my.export.excel') }}" class="btn btn-sm">Export Excel</a>
        </div>
        <table>
            <thead><tr><th>Kode</th><th>Mata Kuliah</th><th>SKS</th><th width="70">Aksi</th></tr></thead>
            <tbody>
                @forelse($mahasiswa->mataKuliahs as $mk)
                    <tr>
                        <td>{{ $mk->kode_matakuliah }}</td>
                        <td>{{ $mk->nama_matakuliah }}</td>
                        <td>{{ $mk->sks }}</td>
                        <td>
                            @php $krsId = \App\Models\Krs::where('npm', $mahasiswa->npm)->where('kode_matakuliah', $mk->kode_matakuliah)->first()->id; @endphp
                            <form action="{{ route('krs.destroy', $krsId) }}" method="POST" onsubmit="return confirm('Drop mata kuliah ini?');">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm">Drop</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4">Belum mengambil mata kuliah apapun</td></tr>
                @endforelse
            </tbody>
        </table>
        <p><strong>Total SKS: {{ $mahasiswa->mataKuliahs->sum('sks') }}</strong></p>
    </div>

    <div class="box box-form" style="flex:1; min-width:280px;">
        <h3 style="margin-top:0;">Ambil Mata Kuliah Baru</h3>
        <form method="POST" action="{{ route('krs.store') }}">
            @csrf
            <label>Pilih Mata Kuliah</label>
            <select name="kode_matakuliah">
                <option value="">-- Pilih --</option>
                @foreach($matakuliahTersedia as $mk)
                    <option value="{{ $mk->kode_matakuliah }}">{{ $mk->nama_matakuliah }} ({{ $mk->sks }} SKS)</option>
                @endforeach
            </select>
            @error('kode_matakuliah') <div class="error-text">{{ $message }}</div> @enderror

            <button class="btn btn-primary" style="width:100%;">Tambahkan ke KRS</button>
        </form>
    </div>
</div>
@endsection
