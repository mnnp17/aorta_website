<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;

use App\Models\Project;

Route::get('/', function () {
    $projectCount = Project::count();
    return view('home', compact('projectCount'));
});

Route::get('/articles', [ArticleController::class, 'landing'])->name('articles');

Route::get('/articles/all', [ArticleController::class, 'publicIndex'])->name('articles.all');
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

Route::get('/projects', [ProjectController::class, 'publicIndex'])->name('projects.index');
Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');

Route::get('/tentang-kami', function () {
    return view('about');
})->name('about');

Route::get('/login', function () {
    return view('register');
})->name('login');

Route::get('/register', function () {
    return redirect('/tentang-kami');
});

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ...

// ...

Route::get('/admin/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('admin.dashboard');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('articles', ArticleController::class);
    Route::resource('projects', ProjectController::class);
    
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
});
