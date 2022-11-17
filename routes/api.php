<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::middleware('auth:sanctum')->group(function () {

    Route::group(['middleware' => ['role:PRODUCT_OWNER|ADMIN']], function () {
        Route::post('/projects', [ProjectController::class, 'store'])->name('project.store');
        Route::post('/tasks', [TaskController::class, 'store'])->name('task.store');
    });

    Route::get('/projects', [ProjectController::class, 'index'])->name('project.index');
    Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('project.show');
    Route::put('/projects/{id}', [ProjectController::class, 'update'])->name('project.update');
    Route::patch('/projects/{id}', [ProjectController::class, 'edit'])->name('project.edit');
    Route::delete('/projects/{id}', [ProjectController::class, 'destroy'])->name('project.destroy');

    Route::get('/tasks', [TaskController::class, 'index'])->name('task.index');
    Route::get('/tasks/{id}', [TaskController::class, 'show'])->name('task.show');
    Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('task.update');
    Route::patch('/tasks/{id}', [TaskController::class, 'edit'])->name('task.edit');
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('task.destroy');

    Route::group(['middleware' => ['role:ADMIN']], function () {
        Route::get('/users', [UserController::class, 'index'])->name('user.index');
        Route::get('/users/{id}', [UserController::class, 'show'])->name('user.show');
        Route::post('/users', [UserController::class, 'store'])->name('user.store');
        Route::put('/users/{id}', [UserController::class, 'update'])->name('user.update');
        Route::patch('/users/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    });

});

