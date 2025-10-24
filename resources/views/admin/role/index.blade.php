<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>ID Role</th>
            <th>Nama Role</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($roles as $role)
            <tr>
                <td>{{ $role->idrole }}</td>
                <td>{{ $role->nama_role }}</td>
            </tr>
        @endforeach
    </tbody>
</table>