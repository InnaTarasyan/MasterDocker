<?php

use App\Http\Controllers\LearningController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LearningController::class, 'home'])->name('home');
Route::get('/learn', [LearningController::class, 'learnIndex'])->name('learn.index');
Route::get('/learn/{slug}', [LearningController::class, 'lesson'])->name('learn.show');
Route::get('/roadmap', [LearningController::class, 'roadmap'])->name('roadmap');
Route::get('/cheatsheet', [LearningController::class, 'cheatsheet'])->name('cheatsheet');
Route::get('/projects', [LearningController::class, 'projects'])->name('projects');
