<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: Arial, sans-serif;
            background: #f0f2f5;
            display: flex;
            justify-content: center;
            padding: 40px 16px;
        }

        .container {
            background: #fff;
            border-radius: 10px;
            padding: 32px;
            width: 100%;
            max-width: 520px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.08);
        }

        h1 { font-size: 1.6rem; margin-bottom: 20px; color: #222; }

        .add-form { display: flex; gap: 8px; margin-bottom: 24px; }

        .add-form input {
            flex: 1;
            padding: 10px 14px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 0.95rem;
            outline: none;
        }

        .add-form input:focus { border-color: #4a90e2; }

        .add-form button {
            padding: 10px 18px;
            background: #4a90e2;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.95rem;
        }

        .add-form button:hover { background: #357abd; }

        .task-list { list-style: none; display: flex; flex-direction: column; gap: 8px; }

        .empty { text-align: center; color: #aaa; padding: 32px 0; font-size: 0.9rem; }

        .task-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px;
            border: 1px solid #eee;
            border-radius: 8px;
            background: #fafafa;
        }

        .task-item.done .task-title { text-decoration: line-through; color: #aaa; }

        .check-btn {
            width: 24px; height: 24px;
            border-radius: 50%;
            border: 2px solid #ccc;
            background: #fff;
            cursor: pointer;
            font-size: 0.7rem;
            color: #4a90e2;
            flex-shrink: 0;
        }

        .task-item.done .check-btn { background: #4a90e2; border-color: #4a90e2; color: #fff; }

        .task-title { flex: 1; cursor: pointer; font-size: 0.95rem; color: #333; }
        .task-title:hover { color: #4a90e2; }

        .edit-form { display: none; flex: 1; gap: 6px; align-items: center; flex-wrap: wrap; }

        .edit-form input {
            flex: 1;
            padding: 6px 10px;
            border: 1px solid #4a90e2;
            border-radius: 6px;
            font-size: 0.9rem;
            outline: none;
        }

        .edit-form button {
            padding: 6px 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.85rem;
        }

        .edit-form button[type="submit"] { background: #4a90e2; color: #fff; }
        .edit-form button[type="button"] { background: #eee; color: #333; }

        .delete-btn {
            background: none; border: none;
            color: #ccc; font-size: 1rem;
            cursor: pointer; padding: 4px; border-radius: 4px;
        }

        .delete-btn:hover { color: #e74c3c; }
        .inline { display: inline; }
        .author {
    text-align: center;
    font-size: 1rem;
    font-weight: 600;
    color: #4a90e2;
    margin-bottom: 6px;
    letter-spacing: 0.5px;
}
    </style>
</head>
<body>
<div class="author">Developed by Jamesden Correa</div>
<div class="container">
<h1 style="text-align:center;">My Tasks</h1>

    <form action="/add" method="POST" class="add-form">
        @csrf
        <input type="text" name="title" placeholder="Add a new task..." required>
        <button type="submit">Add</button>
    </form>

    <ul class="task-list">
        @if($tasks->isEmpty())
            <li class="empty">No tasks yet. Add one above!</li>
        @endif

        @foreach($tasks as $task)
            <li class="task-item {{ $task->done ? 'done' : '' }}">

                <form action="/toggle" method="POST" class="inline">
                    @csrf
                    <input type="hidden" name="id" value="{{ $task->id }}">
                    <button type="submit" class="check-btn">{{ $task->done ? '✔' : '' }}</button>
                </form>

                <span class="task-title" onclick="showEdit({{ $task->id }})">
                    {{ $task->title }}
                </span>

                <form action="/edit" method="POST" class="edit-form" id="edit-{{ $task->id }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $task->id }}">
                    <input type="text" name="title" value="{{ $task->title }}">
                    <button type="submit">Save</button>
                    <button type="button" onclick="hideEdit({{ $task->id }})">Cancel</button>
                </form>

                <form action="/delete" method="POST" class="inline">
                    @csrf
                    <input type="hidden" name="id" value="{{ $task->id }}">
                    <button type="submit" class="delete-btn">✕</button>
                </form>

            </li>
        @endforeach
    </ul>
</div>

<script>
    function showEdit(id) {
        document.querySelector('[onclick="showEdit(' + id + ')"]').style.display = 'none';
        document.getElementById('edit-' + id).style.display = 'flex';
    }
    function hideEdit(id) {
        document.querySelector('[onclick="showEdit(' + id + ')"]').style.display = '';
        document.getElementById('edit-' + id).style.display = 'none';
    }
</script>
</body>
</html>