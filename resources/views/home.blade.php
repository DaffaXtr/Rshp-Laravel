<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rumah Sakit Hewan Pendidikan - Universitas Airlangga</title>

    <link rel="stylesheet" href="{{ asset('/css/home.css') }}">
    <!-- @vite('resources/css/home.css') -->
    
</head>
<body>

    <header>
        <ul class="header">
            <li class="header-li"><a href="/">Home</a></li>
            <li class="header-li"><a href="/struktur">Struktur Organisasi</a></li>
            <li class="header-li"><a href="/layanan">Layanan</a></li>
            <li class="header-li"><a href="/visi">Visi Misi</a></li>
            <li class="header-li"><a href="/login">Login</a></li>
        </ul>
    </header>

    <main>
        <section id="home" class="hero">
            <div class="hero-text">
                <h1>Rumah Sakit Hewan Pendidikan</h1>
                <p>Rumah Sakit Hewan Pendidikan Universitas Airlangga berinovasi untuk selalu meningkatkan kualitas pelayanan, maka dari itu Rumah Sakit Hewan Pendidikan Universitas Airlangga mempunyai fitur pendaftaran online yang mempermudah untuk mendaftarkan hewan kesayangan anda.</p>
                <button onclick="document.getElementById('layanan').scrollIntoView();">Lihat Layanan Kami</button>
            </div>
            <img src="{{ asset('image/rshp-1024x460.jpeg') }}" alt="Gedung Rumah Sakit Hewan Pendidikan">
        </section>
    </main>

    <footer>
        <div>
            Copyright © 2024 Universitas Airlangga. All Rights Reserved.
        </div>
        <div class="foot3">
            <p>Privacy Policy</p>
            <p>Term</p>
            <p>Contact</p>
        </div>
    </footer>

</body>
</html>