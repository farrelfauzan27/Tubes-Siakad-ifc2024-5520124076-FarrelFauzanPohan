<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<style>
    body { font-family: sans-serif; font-size: 12px; }
    h2 { margin-bottom: 0; }
    table { width: 100%; border-collapse: collapse; margin-top: 15px; }
    th, td { border: 1px solid #333; padding: 6px; text-align: left; }
    th { background: #ddd; }
</style>
</head>
<body>
    <h2>Data KRS Mahasiswa</h2>
    <p>Dicetak pada: {{ now()->format('d-m-Y H:i') }}</p>
    <table>
        <thead>
            <tr><th>NPM</th><th>Nama Mahasiswa</th><th>Kode MK</th><th>Mata Kuliah</th><th>SKS</th></tr>
        </thead>
        <tbody>
            @foreach($krsList as $k)
                <tr>
                    <td>{{ $k->npm }}</td>
                    <td>{{ $k->mahasiswa->nama ?? '-' }}</td>
                    <td>{{ $k->mataKuliah->kode_matakuliah ?? '-' }}</td>
                    <td>{{ $k->mataKuliah->nama_matakuliah ?? '-' }}</td>
                    <td>{{ $k->mataKuliah->sks ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
