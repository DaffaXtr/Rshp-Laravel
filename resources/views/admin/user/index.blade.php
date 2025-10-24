<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>ID User</th>
            <th>Nama User</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($user as $usr)
            <tr>
                <td>{{ $usr->iduser }}</td>
                <td>{{ $usr->nama }}</td>
                <td>{{ $usr->email }}</td>
                <td>
                    @foreach ($usr->roleUser as $roleUser)
                        {{ $roleUser->role->nama_role }}@if (!$loop->last), @endif
                    @endforeach
            </tr>
        @endforeach
    </tbody>
</table>