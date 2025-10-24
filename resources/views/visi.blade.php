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
        <section id="visi" class="visi-misi">
            <h2>Visi dan Misi</h2>
            <div class="visi-all">
                <div class="visi-text">
                    <h1>Visi</h1>
                    <p>Menjadi Rumah Sakit Hewan Pendidikan terkemuka di tingkat nasional dan internasional dalam pemberian pelayanan paripurna, pendidikan, dan penelitian di bidang kesehatan hewan, yang unggul dan mandiri serta bermartabat berdasarkan moral, agama, etika dengan tetap berorientasi pada kesejahteraan masyarakat.</p>
                </div>
                <img src="{{ asset('image/rshp-1024x460.jpeg') }}" alt="Ilustrasi Visi RSHP">
            </div>
            <div class="visi-all">
                <img src="{{ asset('image/rshp-1024x460.jpeg') }}" alt="Ilustrasi Misi RSHP">
                <div class="visi-text">
                    <h1>Misi</h1>
                    <ol>
                        <li>Menyelenggarakan fungsi pelayanan terintegrasi, bermutu dan mengutamakan keselamatan dan kesehatan pasien (klien).</li>
                        <li>Menyelenggarakan pendidikan dan pelatihan terintegrasi bidang kedokteran hewan dan kesehatan lainnya untuk menghasilkan lulusan atau tenaga kesehatan yang kompeten di bidangnya.</li>
                        <li>Melakukan penelitian terintegrasi berbasis pada keunggulan bidang kedokteran hewan dan kesehatan lainnya yang berorientasi pada produk inovasi.</li>
                        <li>Menjadi pusat rujukan pelayanan kedokteran hewan dan kesehatan lain yang unggul.</li>
                        <li>Mengembangkan manajemen rumah sakit hewan yang produktif, efisien, bermutu, dan berbasis kinerja.</li>
                    </ol>
                </div>
            </div>
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