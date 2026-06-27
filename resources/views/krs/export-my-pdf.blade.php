<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<style>
    body { font-family: sans-serif; font-size: 12px; }
    table { width: 100%; border-collapse: collapse; margin-top: 15px; }
    th, td { border: 1px solid #333; padding: 6px; text-align: left; }
    th { background: #ddd; }
</style>
</head>
<body>
    <h2>Kartu Rencana Studi (KRS)</h2>
    <p>
        NPM: {{ $mahasiswa->npm }}<br>
        Nama: {{ $mahasiswa->nama }}<br>
        Dosen Wali: {{ $mahasiswa->dosen->nama ?? '-' }}
    </p>
    <table>
        <thead>
            <tr><th>Kode MK</th><th>Mata Kuliah</th><th>SKS</th></tr>
        </thead>
        <tbody>
            @foreach($mahasiswa->mataKuliahs as $mk)
                <tr>
                    <td>{{ $mk->kode_matakuliah }}</td>
                    <td>{{ $mk->nama_matakuliah }}</td>
                    <td>{{ $mk->sks }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p><strong>Total SKS: {{ $mahasiswa->mataKuliahs->sum('sks') }}</strong></p>
</body>
</html>
