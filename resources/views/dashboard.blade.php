<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Administrator</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen">

    <div class="flex flex-col md:flex-row">
        {{-- Sidebar/menu (opsional) --}}
        <aside class="bg-blue-800 text-white w-full md:w-64 p-4">
            <h2 class="text-xl font-semibold mb-4">Menu Utama</h2>
            <ul class="space-y-2">
                <li><a href="/dashboard" class="hover:underline">Dashboard</a></li>
                <li><a href="/datamaster" class="hover:underline">Manajemen Data Master</a></li>
                <li><a href="{{ route('logout') }}" class="hover:underline text-red-300">Logout</a></li>
            </ul>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 p-6">
            <header class="mb-6">
                <h1 class="text-3xl font-bold text-gray-700">
                    Selamat datang, {{ $user['nama'] }}!
                </h1>
                <p class="text-gray-500">Peran: {{ $user['role'] }}</p>
            </header>

            <section class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-lg shadow p-4 text-center">
                    <h4 class="text-gray-500">Total Pengguna</h4>
                    <h2 class="text-3xl font-bold text-blue-600 mt-2">15</h2>
                </div>
                <div class="bg-white rounded-lg shadow p-4 text-center">
                    <h4 class="text-gray-500">Hewan Terdaftar</h4>
                    <h2 class="text-3xl font-bold text-blue-600 mt-2">42</h2>
                </div>
                <div class="bg-white rounded-lg shadow p-4 text-center">
                    <h4 class="text-gray-500">Kunjungan Hari Ini</h4>
                    <h2 class="text-3xl font-bold text-blue-600 mt-2">8</h2>
                </div>
            </section>

            <section class="bg-white rounded-lg shadow p-6 mt-8">
                <h3 class="text-xl font-semibold mb-3">Aksi Cepat</h3>
                <p class="text-gray-600">Gunakan link di bawah ini untuk langsung mengelola data utama sistem.</p>
                <a href="/datamaster" class="inline-block bg-blue-600 text-white px-4 py-2 rounded mt-4 hover:bg-blue-700">
                    Buka Manajemen Data Master
                </a>
            </section>
        </main>
    </div>

</body>
</html>
