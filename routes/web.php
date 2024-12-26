<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\MarkdownController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\StatisticsController;

Route::get('/', function () {
    return view('/home');
});

Route::get('/home', function () {
    return view('/home');
});

// Route::get('/markdown', [MarkdownController::class, 'showMD']);
Route::get('/register', [AccountController::class, 'showRegistrationForm'])->name('register');

Route::post('/register', [AccountController::class, 'register']);
Route::get('/register-success', function () {
    return view('register-success');
})->name('register.success');

Route::get('/login', [AccountController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AccountController::class, 'login']);

Route::post('/logout', [AccountController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/questions/create', [QuestionController::class, 'create'])->name('questions.create');
    Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');
});

Route::get('/problems', [QuestionController::class, 'listProblems'])->name('questions.problems');
Route::get('/problems/{id}', [QuestionController::class, 'show'])->name('questions.show');
Route::middleware(['auth'])->group(function () {
    Route::post('/problems/{id}/submit', [QuestionController::class, 'submitAnswer'])->name('questions.submit');
});

Route::get('/statistics', [StatisticsController::class, 'index'])->name('statistics');

Route::get('/aboutus', function () {
    return view('aboutus');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/sqldata', [StatisticsController::class, 'showSqlData'])->name('statistics.sqldata');
});