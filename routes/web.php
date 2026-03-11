<?php
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TaskController::class, 'index']);
Route::post('/add', [TaskController::class, 'add']);
Route::post('/edit', [TaskController::class, 'edit']);
Route::post('/delete', [TaskController::class, 'delete']);
Route::post('/toggle', [TaskController::class, 'toggle']);