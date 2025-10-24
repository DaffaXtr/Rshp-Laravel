<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>ID Kategori</th>
            <th>Nama Kategori</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kategori as $kat)
            <tr>
                <td>{{ $kat->idkategori }}</td>
                <td>{{ $kat->nama_kategori }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
