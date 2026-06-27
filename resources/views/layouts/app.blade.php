<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SIAKAD')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="navbar">
    <div class="brand">SIAKAD</div>
    <ul class="menu">
        <li><a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a></li>
        @auth
            @if(auth()->user()->isAdmin())
                <li><a href="{{ route('dosen.index') }}" class="{{ request()->routeIs('dosen.*') ? 'active' : '' }}">Dosen</a></li>
                <li><a href="{{ route('mahasiswa.index') }}" class="{{ request()->routeIs('mahasiswa.*') ? 'active' : '' }}">Mahasiswa</a></li>
                <li><a href="{{ route('matakuliah.index') }}" class="{{ request()->routeIs('matakuliah.*') ? 'active' : '' }}">Mata Kuliah</a></li>
                <li><a href="{{ route('jadwal.index') }}" class="{{ request()->routeIs('jadwal.*') ? 'active' : '' }}">Jadwal</a></li>
                <li><a href="{{ route('krs.index') }}" class="{{ request()->routeIs('krs.index') ? 'active' : '' }}">Data KRS</a></li>
            @else
                <li><a href="{{ route('krs.my') }}" class="{{ request()->routeIs('krs.my') ? 'active' : '' }}">KRS Saya</a></li>
            @endif
        @endauth
    </ul>
    @auth
        <div class="user-info">
            <span>{{ auth()->user()->name }} <span class="badge">{{ auth()->user()->role }}</span></span>
            <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    @endauth
</div>

<div class="container">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @yield('content')
</div>

</body>
</html>
