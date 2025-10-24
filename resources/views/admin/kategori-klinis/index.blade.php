<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>ID Kategori Klinis</th>
            <th>Nama Kategori Klinis</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kategoriKlinis as $kat)
            <tr>
                <td>{{ $kat->idkategori_klinis }}</td>
                <td>{{ $kat->nama_kategori_klinis }}</td>
            </tr>
        @endforeach
    </tbody>
</table>