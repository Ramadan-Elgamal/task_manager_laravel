<?php

use App\Http\Controllers\Api\TaskApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::name('api.')->group(function () {
        Route::get('/tasks', [TaskApiController::class, 'index'])->name('tasks.index');
        Route::post('/tasks', [TaskApiController::class, 'store'])->name('tasks.store');
        Route::get('/tasks/{task}', [TaskApiController::class, 'show'])->name('tasks.show');
        Route::match(['put', 'patch'], '/tasks/{task}', [TaskApiController::class, 'update'])->name('tasks.update');
        Route::delete('/tasks/{task}', [TaskApiController::class, 'destroy'])->name('tasks.destroy');
    });
});