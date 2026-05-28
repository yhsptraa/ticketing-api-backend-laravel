<!DOCTYPE html>
<html>
    <head>
        <title>Create Studio</title>
    </head>
    <body>
        <h1>Menambahkan Studio</h1>
        <form action="/admin/studios" method="POST">
            @csrf
            <label>Studio Name</label><br>
            <input type="text" name="studio_name"><br>
            <label>Capacity</label><br>
            <input type="number" name="capacity"><br>
            <label>Description</label><br>
            <textarea name="description"></textarea><br>
            <label>Status</label><br>
            <select name="is_active">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select><br>
            <button type="submit">Save</button>
        </form>
    </body>
</html>