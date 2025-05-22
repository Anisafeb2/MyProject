<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Perpustakaan') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet" />

    <!-- Bootstrap Icons -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
    />

    <!-- Styles -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        /* Font & basic background */
        body {
            font-family: 'Nunito', sans-serif;
            background: #f5f7fa;
            color: #333;
            min-height: 100vh;
            margin: 0;
        }

        /* Sidebar with gradient background */
        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: #f0f0f0;
            box-shadow: 2px 0 10px rgba(0,0,0,0.15);
            display: flex;
            flex-direction: column;
            justify-content: start;
            padding-top: 20px;
            overflow-y: auto;
            z-index: 1000;
        }

        /* Profile section */
        .sidebar .profile {
            text-align: center;
            padding: 25px 15px;
            border-bottom: 1px solid rgba(255,255,255,0.15);
            font-weight: 600;
            font-size: 1.1rem;
            user-select: none;
        }
        .sidebar .profile i {
            font-size: 3rem;
            margin-bottom: 8px;
            color: #fff;
        }

        /* Sidebar navigation links */
        .sidebar a {
            display: flex;
            align-items: center;
            color: #e0e0e0;
            text-decoration: none;
            padding: 15px 25px;
            font-weight: 500;
            font-size: 1rem;
            border-left: 4px solid transparent;
            transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease;
            user-select: none;
        }
        .sidebar a i {
            margin-right: 12px;
            font-size: 1.3rem;
        }
        .sidebar a:hover {
            background-color: rgba(255, 255, 255, 0.15);
            border-left: 4px solid #fff;
            color: #fff;
        }
        .sidebar a.active {
            background-color: rgba(255, 255, 255, 0.25);
            border-left: 4px solid #fff;
            color: #fff;
            font-weight: 700;
        }

        /* Main content area */
        .content {
            padding: 30px 40px;
            background: #fff;
            min-height: 100vh;
            box-shadow: -2px 0 10px rgba(0,0,0,0.05);
            border-radius: 0 12px 12px 0;
            transition: margin-left 0.3s ease;
        }

        /* Jika sidebar aktif (user login), beri margin kiri untuk konten */
        body.authenticated .content {
            margin-left: 260px;
        }

        /* Scrollbar for sidebar */
        .sidebar::-webkit-scrollbar {
            width: 8px;
        }
        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.2);
            border-radius: 4px;
        }
        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255,255,255,0.4);
        }
    </style>
</head>
<body class="{{ auth()->check() ? 'authenticated' : '' }}">
    <div id="app" class="d-flex">
        {{-- Sidebar hanya muncul kalau sudah login --}}
        @auth
        <div class="sidebar">
            <div class="profile">
                <i class="bi bi-person-circle"></i>
                <div class="mt-2">{{ Auth::user()->name }}</div>
            </div>

            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-house-door"></i> Dashboard
            </a>
            <a href="{{ route('databuku.index') }}" class="{{ request()->routeIs('databuku.*') ? 'active' : '' }}">
                <i class="bi bi-journal-bookmark-fill"></i> Data Buku
            </a>
            <a href="{{ route('dataanggota.index') }}" class="{{ request()->routeIs('dataanggota.*') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i> Data Anggota
            </a>
            <a href="{{ route('peminjaman.index') }}" class="{{ request()->routeIs('peminjaman.*') ? 'active' : '' }}">
                <i class="bi bi-arrow-left-right"></i> Peminjaman
            </a>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            >
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
            <form
              id="logout-form"
              action="{{ route('logout') }}"
              method="POST"
              class="d-none"
            >
                @csrf
            </form>
        </div>
        @endauth

        {{-- Main Content --}}
        <main class="content flex-grow-1">
            @yield('content')
        </main>
    </div>
</body>
</html>
