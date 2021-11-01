<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::group(['prefix'=>'users', 'middleware'=> ['auth:sanctum', 'verified']], function () {
    Route::get('/subjects', [\App\Http\Controllers\UserController::class, 'index'])->name('user.index');
    Route::get('/subjects/{subject}', [\App\Http\Controllers\UserController::class, 'show'])->name('user.show');
});

Route::group(['prefix'=>'subjects', 'middleware'=> ['auth:sanctum', 'verified']], function () {
    Route::get('/', [\App\Http\Controllers\SubjectController::class, 'index'])->name('subject.index');
    Route::get('/create', [\App\Http\Controllers\SubjectController::class, 'create'])->name('subject.create');
    Route::get('/{subject}', [\App\Http\Controllers\SubjectController::class, 'show'])->name('subject.show');
    Route::get('/{subject}/edit', [\App\Http\Controllers\SubjectController::class, 'edit'])->name('subject.edit');
    Route::post('/', [\App\Http\Controllers\SubjectController::class, 'store'])->name('subject.store');
    Route::patch('/{subject}', [\App\Http\Controllers\SubjectController::class, 'update'])->name('subject.update');
    Route::patch('/{subject}/apply', [\App\Http\Controllers\SubjectController::class, 'apply'])->name("subject.apply");
    Route::delete('/{subject}', [\App\Http\Controllers\SubjectController::class, 'destroy'])->name('subject.destroy');
    Route::delete('/{subject}/apply', [\App\Http\Controllers\SubjectController::class, 'unapply'])->name("subject.unapply");
});
