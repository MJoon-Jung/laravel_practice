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


// Route::get('api/auth/login', [AuthController::class, "redirectToProvider"])->name('login');
// Route::get('api/auth/login/callback', [AuthController::class, "handleProviderCallback"]);

Route::group([
    'prefix' => 'api/auth',
], function ($router) {
    Route::group([
        'prefix' => 'login',
        'middleware' => 'guest',
    ], function ($router) {
        Route::get('/', [AuthController::class, "redirectToProvider"])->name('login');
        Route::get('/callback', [AuthController::class, "handleProviderCallback"]);
    });
    Route::group([
        'middleware' => 'auth',
    ], function ($router) {
        Route::post('/logout', [AuthController::class, "logout"]);
    });
});
