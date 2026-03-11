<?php
require_once 'TaskManager.php';

$taskManager = new TaskManager();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $id     = (int)($_POST['id'] ?? 0);
    $title  = trim($_POST['title'] ?? '');

    if ($action === 'add' && $title !== '')       $taskManager->addTask($title);
    if ($action === 'edit' && $id && $title !== '') $taskManager->editTask($id, $title);
    if ($action === 'delete' && $id)               $taskManager->deleteTask($id);
    if ($action === 'toggle' && $id)               $taskManager->toggleTask($id);

    header('Location: index.php');
    exit;
}

$tasks = $taskManager->getTasks();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">

    <h1>My Tasks</h1>

    <form method="POST" class="add-form">
        <input type="hidden" name="action" value="add">
        <input type="text" name="title" placeholder="Add a new task..." required>
        <button type="submit">Add</button>
    </form>

    <ul class="task-list">
        <?php if (empty($tasks)): ?>
            <li class="empty">No tasks yet. Add one above!</li>
        <?php endif; ?>

        <?php foreach ($tasks as $task): ?>
            <li class="task-item <?= $task['done'] ? 'done' : '' ?>">

                <form method="POST" class="inline">
                    <input type="hidden" name="action" value="toggle">
                    <input type="hidden" name="id" value="<?= $task['id'] ?>">
                    <button type="submit" class="check-btn"><?= $task['done'] ? '✔' : '' ?></button>
                </form>

                <span class="task-title" onclick="showEdit(<?= $task['id'] ?>)">
                    <?= htmlspecialchars($task['title']) ?>
                </span>

                <form method="POST" class="edit-form" id="edit-<?= $task['id'] ?>">
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="id" value="<?= $task['id'] ?>">
                    <input type="text" name="title" value="<?= htmlspecialchars($task['title']) ?>">
                    <button type="submit">Save</button>
                    <button type="button" onclick="hideEdit(<?= $task['id'] ?>)">Cancel</button>
                </form>

                <form method="POST" class="inline">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" value="<?= $task['id'] ?>">
                    <button type="submit" class="delete-btn">✕</button>
                </form>

            </li>
        <?php endforeach; ?>
    </ul>

</div>
<script src="app.js"></script>
</body>
</html>
