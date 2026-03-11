<?php
namespace App\Http\Controllers;
use App\Models\Task;

class TaskController extends Controller {

    public function index() {
        $tasks = Task::orderBy('id', 'desc')->get();
        return view('tasks', compact('tasks'));
    }

    public function add() {
        Task::create([
            'title' => request('title'),
            'done'  => false
        ]);
        return redirect('/');
    }

    public function edit() {
        Task::where('id', request('id'))->update(['title' => request('title')]);
        return redirect('/');
    }

    public function delete() {
        Task::where('id', request('id'))->delete();
        return redirect('/');
    }

    public function toggle() {
        $task = Task::find(request('id'));
        $task->update(['done' => !$task->done]);
        return redirect('/');
    }
}