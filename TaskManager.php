<?php
require_once 'db.php';

class TaskManager {
    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function getTasks() {
        $stmt = $this->pdo->query('SELECT * FROM tasks ORDER BY id DESC');
        return $stmt->fetchAll();
    }

    public function addTask($title) {
        $stmt = $this->pdo->prepare('INSERT INTO tasks (title, done) VALUES (:title, 0)');
        $stmt->execute([':title' => $title]);
    }

    public function editTask($id, $title) {
        $stmt = $this->pdo->prepare('UPDATE tasks SET title = :title WHERE id = :id');
        $stmt->execute([':title' => $title, ':id' => $id]);
    }

    public function deleteTask($id) {
        $stmt = $this->pdo->prepare('DELETE FROM tasks WHERE id = :id');
        $stmt->execute([':id' => $id]);
    }

    public function toggleTask($id) {
        $stmt = $this->pdo->prepare('UPDATE tasks SET done = NOT done WHERE id = :id');
        $stmt->execute([':id' => $id]);
    }
}
