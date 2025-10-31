<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- CSRF Token dari layout lama -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Font Awesome untuk Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font (Menggantikan Nunito) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">


    <!-- CSS Kustom untuk Sidebar dan Tema (Menggunakan Kelas Bootstrap) -->
    <style>
        /* Definisi Variabel Utama */
        :root {
            --primary-blue: #1d8cf8; 
            --secondary-blue: #1e70e9; 
            --sidebar-width: 260px; 
            --sidebar-bg-start: #233342;
            --sidebar-bg-end: #1d2c3c;
            --sidebar-text: #ecf0f1;
            --hover-bg: rgba(29, 140, 248, 0.2); 
            --active-bg: var(--primary-blue);
        }
        
        body {
            background-color: #f0f4f8; 
            font-family: 'Inter', sans-serif; /* Menggunakan font modern */
        }

        /* Styling Sidebar (Struktur dasar) */
        .sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--sidebar-bg-start) 0%, var(--sidebar-bg-end) 100%);
            color: var(--sidebar-text);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.15); 
            overflow-y: auto;
            z-index: 1050; 
        }

        /* Styling Tautan di Sidebar (Menggantikan style kaku) */
        .sidebar .nav-link {
            color: var(--sidebar-text);
            padding: 12px 25px; 
            display: block;
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s;
            border-radius: 8px; 
            margin: 5px 15px;
        }

        .sidebar .nav-link:hover {
            background-color: var(--hover-bg);
            color: #ffffff;
        }

        .sidebar .nav-link.active {
            background-color: var(--active-bg);
            box-shadow: 0 4px 6px rgba(29, 140, 248, 0.3);
            color: #ffffff;
            font-weight: 600;
        }

        .sidebar .profile-info {
            padding: 0 25px 20px 25px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 15px;
        }
        
        /* Konten Utama */
        .main-content {
            padding: 20px;
            min-height: 100vh;
            /* Perlu disesuaikan margin-left berdasarkan status auth */
            margin-left: 0; 
        }
        
        /* Hanya terapkan margin jika user sudah login (sidebar terlihat) */
        .has-sidebar .main-content {
            margin-left: var(--sidebar-width);
        }

        /* Navbar Header */
        .main-header {
            z-index: 1000;
        }

        .sidebar-heading {
            color: #b7c0cd !important;
            padding-left: 30px !important;
        }
    </style>
</head>
<body class="{{ Auth::check() ? 'has-sidebar' : '' }}">
    <div id="app">
        
        @auth
        <!-- SIDEBAR - Area Navigasi Utama (Hanya Tampil Jika Login) -->
        <div class="sidebar">
            <h4 class="text-center my-4" style="color: var(--primary-blue); font-weight: 800;">
                <i class="fas fa-heartbeat"></i> E-KLINIK
            </h4>
            
            <div class="profile-info">
                <p class="mb-0 text-white fw-bold">{{ session('user_name') ?? Auth::user()->name }}</p>
                <small class="text-muted">{{ session('user_role_name') ?? 'Admin' }}</small>
            </div>
            
            <nav class="nav flex-column">
                <!-- Dashboard Home -->
                <a class="nav-link active" href="{{ route('home') }}">
                    <i class="fas fa-tachometer-alt fa-fw me-2"></i> Dashboard
                </a>
                
                <h6 class="sidebar-heading px-3 mt-4 mb-1 text-muted text-uppercase">
                    Data Master
                </h6>
                
                <a class="nav-link" href="{{ route('admin.pemilik.index') }}">
                    <i class="fas fa-user-tag fa-fw me-2"></i> Pemilik Hewan
                </a>
                <a class="nav-link" href="{{ route('admin.pet.index') }}">
                    <i class="fas fa-paw fa-fw me-2"></i> Data Pasien (Pet)
                </a>
                <a class="nav-link" href="{{ route('admin.jenis-hewan.index') }}">
                    <i class="fas fa-dog fa-fw me-2"></i> Jenis Hewan
                </a>
                <a class="nav-link" href="{{ route('admin.ras-hewan.index') }}">
                    <i class="fas fa-cat fa-fw me-2"></i> Ras Hewan
                </a>
                
                <h6 class="sidebar-heading px-3 mt-4 mb-1 text-muted text-uppercase">
                    Manajemen Klinik
                </h6>
                <a class="nav-link" href="{{ route('admin.kategori.index') }}">
                    <i class="fas fa-list-ul fa-fw me-2"></i> Kategori Tindakan
                </a>
                <a class="nav-link" href="{{ route('admin.kategori-klinis.index') }}">
                    <i class="fas fa-stethoscope fa-fw me-2"></i> Kategori Klinis
                </a>
                <a class="nav-link" href="{{ route('admin.kode-tindakan-terapi.index') }}">
                    <i class="fas fa-syringe fa-fw me-2"></i> Kode Tindakan/Terapi
                </a>

                <h6 class="sidebar-heading px-3 mt-4 mb-1 text-muted text-uppercase">
                    Sistem
                </h6>
                <a class="nav-link" href="{{ route('admin.user.index') }}">
                    <i class="fas fa-users fa-fw me-2"></i> User
                </a>
                <a class="nav-link" href="{{ route('admin.role.index') }}">
                    <i class="fas fa-user-shield fa-fw me-2"></i> Roles
                </a>
                
                <!-- Logout Button Sidebar -->
                <div class="p-3">
                    <button class="btn btn-danger w-100 mt-4 shadow-sm"
                        onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();">
                        <i class="fas fa-sign-out-alt fa-fw me-2"></i> Logout
                    </button>
                </div>
            </nav>
        </div>
        @endauth
        
        <!-- MAIN CONTENT (Header dan Konten) -->
        <div class="main-content">
            
            @guest
            <!-- Navbar Default untuk Guest/Belum Login -->
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}" style="color: var(--primary-blue);">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto">
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
    
                             @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>
            @endguest
            
            @auth
            <!-- Navbar/Header Minimalis untuk User yang Sudah Login -->
            <header class="main-header navbar navbar-expand-lg navbar-light p-3 mb-4 bg-white rounded-3 shadow-sm ">
                <div class="container-fluid">
                    <span class="navbar-brand mb-0 h1" style="color: var(--primary-blue);">Panel Administrasi Klinik</span>
                    
                    <button class="btn btn-outline-danger shadow-sm" 
                            onclick="event.preventDefault(); document.getElementById('logout-form-header').submit();">
                            <i class="fas fa-sign-out-alt me-1"></i> Logout ({{ Auth::user()->nama ?? 'User' }})
                    </button>
                </div>
            </header>
            @endauth

            <main class="py-4">
                @yield('content')
            </main>
        </div>

        <!-- FORM LOGOUT TERSEMBUNYI (PENTING UNTUK KEAMANAN POST) -->
        @auth
        <form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
        <form id="logout-form-header" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
        @endauth

    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
