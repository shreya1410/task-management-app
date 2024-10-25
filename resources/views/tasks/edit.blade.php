<h1>Edit Task</h1>

<form action="{{ route('tasks.update', $task->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="name">Task Name:</label>
    <input type="text" name="name" id="name" value="{{ $task->name }}" required>

    <label for="description">Descr<h1>Edit Task</h1>

<form action="{{ route('tasks.update', $task->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label for="name">Task Name:</label>
    <input type="text" name="name" value="{{ $task->name }}" required>

    <label for="description">Description:</label>
    <textarea name="description">{{ $task->description }}</textarea>

    <label for="status">Status:</label>
    <select name="status">
        <option value="Pending" {{ $task->status === 'Pending' ? 'selected' : '' }}>Pending</option>
        <option value="In Progress" {{ $task->status === 'In Progress' ? 'selected' : '' }}>In Progress</option>
        <option value="Completed" {{ $task->status === 'Completed' ? 'selected' : '' }}>Completed</option>
    </select>

    <button type="submit">Update Task</button>
</form>

<a href="{{ route('tasks.index') }}">Back to Task List</a>
iption:</label>
    <textarea name="description" id="description">{{ $task->description }}</textarea>

    <label for="status">Status:</label>
    <select name="status" id="status">
        <option value="Pending" {{ $task->status == 'Pending' ? 'selected' : '' }}>Pending</option>
        <option value="In Progress" {{ $task->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
        <option value="Completed" {{ $task->status == 'Completed' ? 'selected' : '' }}>Completed</option>
    </select>

    <button type="submit">Update Task</button>
</form>
