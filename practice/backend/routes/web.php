<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
})->name('home');
Route::get('/dashboard', function () {
    return view('welcome');
});

Route::prefix('/api/auth/google')->group(function () {
    Route::get('/', [LoginController::class, 'redirectToProvider'])->name('login');
    Route::get('/redirect', [LoginController::class, 'handleProviderCallback']);
});
