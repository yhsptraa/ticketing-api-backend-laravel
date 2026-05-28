<a href="{{ route('admin.schedules.edit', $schedule->id) }}">
    Edit
</a>

|

<form action="{{ route('admin.schedules.destroy', $schedule->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')

    <button type="submit">
        Delete
    </button>
</form>