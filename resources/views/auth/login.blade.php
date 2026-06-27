<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - SIAKAD</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<div class="login-wrapper">
    <div class="login-box">
        <h2>SIAKAD</h2>
        <p class="subtitle">Sistem Informasi Akademik</p>

        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login.submit') }}">
            @csrf
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <div style="margin-bottom: 12px;">
                <input type="checkbox" name="remember" id="remember" style="width:auto;">
                <label for="remember" style="display:inline; font-weight:normal;">Ingat saya</label>
            </div>

            <button type="submit" class="btn btn-primary" style="width:100%;">Login</button>
        </form>
    </div>
</div>
</body>
</html>
