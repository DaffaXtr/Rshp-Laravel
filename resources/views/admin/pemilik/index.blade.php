<table>
    <thead>
        <tr>
            <th>ID Pemilik</th>
            <th>Nama Pemilik</th>
            <th>No WA</th>
            <th>Alamat</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pemilik as $owner)
            <tr>
                <td>{{ $owner->idpemilik }}</td>
                <td>{{ $owner->user->nama }}</td>
                <td>{{ $owner->no_wa }}</td>
                <td>{{ $owner->alamat }}</td>
            </tr>
        @endforeach
    </tbody>
</table>