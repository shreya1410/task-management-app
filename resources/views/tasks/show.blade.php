<h1>{{ $task->name }}</h1>

<p><strong>Description:</strong> {{ $task->description }}</p>

<p><strong>Status:</strong> {{ $task->status }}</p>

<a href="{{ route('tasks.edit', $task->id) }}">Edit Task</a>

<form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit">Delete Task</button>
</form>

<a href="{{ route('tasks.index') }}">Back to Task List</a>
