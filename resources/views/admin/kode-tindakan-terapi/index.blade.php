<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>ID Tindakan Terapi</th>
            <th>Kode</th>
            <th>Deskripsi</th>
            <th>Nama Kategori</th>
            <th>Nama Kategori Klinis</th>
        </tr>
    </thead>
    <tbody>
        @php
            // Kelompokkan data berdasarkan Kategori Klinis dan Kategori
            $grouped = $kodeTindakanTerapi->groupBy([
                'kategoriKlinis.nama_kategori_klinis',
                'kategori.nama_kategori'
            ]);
        @endphp

        @foreach ($grouped as $namaKlinis => $kategoriGroup)
            @php
                // Hitung total baris dalam kategori klinis ini (untuk rowspan klinis)
                $rowspanKlinis = $kategoriGroup->flatten(1)->count();
                $isFirstKlinis = true;
            @endphp

            @foreach ($kategoriGroup as $namaKategori => $kodeList)
                @php
                    $rowspanKategori = $kodeList->count();
                    $isFirstKategori = true;
                @endphp

                @foreach ($kodeList as $kode)
                    <tr>
                        <td>{{ $kode->idkode_tindakan_terapi }}</td>
                        <td>{{ $kode->kode }}</td>
                        <td>{{ $kode->deskripsi_tindakan_terapi }}</td>

                        {{-- tampilkan kategori klinis sekali di atas seluruh kelompok --}}
                        @if ($isFirstKlinis)
                            <td rowspan="{{ $rowspanKategori }}">{{ $namaKategori }}</td>
                            <td rowspan="{{ $rowspanKlinis }}">{{ $namaKlinis }}</td>
                            @php $isFirstKlinis = false; @endphp
                        @elseif ($isFirstKategori)
                            {{-- tampilkan kategori sekali per kelompok kategori --}}
                            <td rowspan="{{ $rowspanKategori }}">{{ $namaKategori }}</td>
                        @endif

                        @php $isFirstKategori = false; @endphp
                    </tr>
                @endforeach
            @endforeach
        @endforeach
    </tbody>
</table>
