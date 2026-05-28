<a href="/admin/schedules/{{ $schedule->id }}/edit">
    Edit
</a>

|

<form action="/admin/schedules/{{ $schedule->id }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')

    <button type="submit">
        Delete
    </button>
</form>