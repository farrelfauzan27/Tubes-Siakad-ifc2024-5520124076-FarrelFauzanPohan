<!DOCTYPE html>
<html>
<head>
<title>403 Forbidden</title>
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<div class="login-wrapper" style="background:#fff;">
    <div style="text-align:center;">
        <h1>403</h1>
        <p>{{ $exception->getMessage() ?: 'Anda tidak memiliki akses ke halaman ini.' }}</p>
        <a href="{{ route('dashboard') }}" class="btn btn-primary">Kembali ke Dashboard</a>
    </div>
</div>
</body>
</html>
