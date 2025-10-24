<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>ID Ras</th>
            <th>Nama Jenis</th>
            <th>Nama Ras</th>
        </tr>
    </thead>
    <tbody>
        @php
            // Kelompokkan ras berdasarkan jenis
            $grouped = $rasHewan->groupBy('jenisHewan.nama_jenis_hewan');
        @endphp

        @foreach ($grouped as $namaJenis => $rasList)
            @php $rowspan = $rasList->count(); @endphp

            @foreach ($rasList as $index => $ras)
                <tr>
                    <td>{{ $ras->idras_hewan }}</td>

                    {{-- Tampilkan Nama Jenis hanya di baris pertama --}}
                    @if ($index === 0)
                        <td rowspan="{{ $rowspan }}">{{ $namaJenis }}</td>
                    @endif

                    <td>{{ $ras->nama_ras }}</td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>
