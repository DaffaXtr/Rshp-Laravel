<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>ID Pet</th>
            <th>Nama Pet</th>
            <th>Tanggal Lahir</th>
            <th>Warna</th>
            <th>Jenis Kelamin</th>
            <th>Nama Pemilik</th>
            <th>Nama Ras</th>
            <th>Nama Jenis</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pet as $p)
            <tr>
                <td>{{ $p->idpet }}</td>
                <td>{{ $p->nama }}</td>
                <td>{{ $p->tanggal_lahir }}</td>
                <td>{{ $p->warna_tanda }}</td>
                <td>{{ $p->jenis_kelamin ? 'Jantan' : 'Betina' }}</td>
                <td>{{ $p->pemilik->user->nama }}</td>
                <td>{{ $p->rasHewan->nama_ras }}</td>
                <td>{{ $p->rasHewan->jenisHewan->nama_jenis_hewan }}</td>
            </tr>
        @endforeach
    </tbody>

</table>