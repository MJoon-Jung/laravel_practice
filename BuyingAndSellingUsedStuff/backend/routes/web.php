<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Request as FacadesRequest;
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
});


Route::group([
    'prefix' => 'api/auth',
    'middleware' => 'auth:web',
], function ($router) {
    Route::get('/login', [AuthController::class, "redirectToProvider"])->name('login');
    Route::get('/login/callback', [AuthController::class, "handleProviderCallback"]);
    Route::get('/me', [AuthController::class, "handleProviderCallback"]);
});
