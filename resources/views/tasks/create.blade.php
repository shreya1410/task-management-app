<h1>Create Task</h1>

<form action="{{ route('tasks.store') }}" method="POST">
    @csrf
    <label for="name">Task Name:</label>
    <input type="text" name="name" required>

    <label for="description">Description:</label>
    <textarea name="description"></textarea>

    <label for="status">Status:</label>
    <select name="status">
        <option value="Pending">Pending</option>
        <option value="In Progress">In Progress</option>
        <option value="Completed">Completed</option>
    </select>

    <button type="submit">Create Task</button>
</form>

<a href="{{ route('tasks.index') }}">Back to Task List</a>
