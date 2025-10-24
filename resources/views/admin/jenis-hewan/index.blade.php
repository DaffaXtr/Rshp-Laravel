<table>
    <thead>
        <tr>
            <th>ID Jenis Hewan</th>
            <th>Nama Jenis</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($jenisHewan as $jenis)
            <tr>
                <td>{{ $jenis->idjenis_hewan }}</td>
                <td>{{ $jenis->nama_jenis_hewan }}</td>
            </tr>
        @endforeach
    </tbody>
</table>