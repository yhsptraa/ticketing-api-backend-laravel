<!DOCTYPE html>
<html>
    <head>
        <title>Edit Studio</title>
    </head>
    <body>
        <h1>Mengubah Studio</h1>
        <form action="/admin/studios/{{ $studio->id }}" method="POST">
            @csrf
            @method('PUT')
            <label>Studio Name</label><br>
            <input type="text" name="studio_name"
                value="{{ $studio->studio_name }}"><br>
            <label>Capacity</label><br>
            <input type="number" name="capacity"
                value="{{ $studio->capacity }}"><br>
            <label>Description</label><br>
            <textarea name="description">{{ $studio->description }}</textarea><br><br>
            <label>Status</label><br>
            <select name="is_active">
                <option value="1" {{ $studio->is_active ?'selected' : '' }}>
                    Active
                </option>
                <option value="0" {{ !$studio->is_active ?'selected' : '' }}>
                    Inactive
                </option>
            </select><br>
            <button type="submit">Update</button>
        </form>
    </body>
</html>