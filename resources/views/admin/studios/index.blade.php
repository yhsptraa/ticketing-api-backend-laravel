<!DOCTYPE html>
<html>
    <head>
        <title>Studio</title>
    </head>
    <body>
        <h1>Daftar Studio</h1>
        <a href="/admin/studios/create">Tambah Studio</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Studio Name</th>
                    <th>Capacity</th>
                    <th>Description</th>
                    <th>Is Active</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($studios as $studio)
                    <tr>
                        <td>{{ $studio->id }}</td>
                        <td>{{ $studio->studio_name }}</td>
                        <td>{{ $studio->capacity }}</td>
                        <td>{{ $studio->description }}</td>
                        <td>{{ $studio->is_active ? 'Active' : 'Not Active'}}</td>
                        <td>
                            <a href="/admin/studios/{{ $studio->id }}/edit">Edit</a>
                            <form action="/admin/studios/{{ $studio->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>