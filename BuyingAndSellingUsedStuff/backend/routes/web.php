<?php

use App\Domains\Post\Controllers\PostController;
use App\Domains\User\Controller\UserController;
use App\Domains\User\Controller\AuthController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\GroupUserController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomUserController;
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


//Auth
Route::group([
    'prefix' => 'api/auth/login',
    'middleware' => 'guest',
], function () {
    Route::get('/', [AuthController::class, "redirectToProvider"])->name('login');
    Route::get('/callback', [AuthController::class, "handleProviderCallback"]);
});

Route::group([
    'prefix' => 'api/auth',
    'middleware' => 'auth',
], function () {
    Route::post('/logout', [AuthController::class, "logout"]);
});

//User
Route::group([
    'prefix' => 'api/users',
    'middleware' => 'auth',
], function () {
    Route::get('/', [UserController::class, "index"]);
    Route::get('/{id}', [UserController::class, "show"]);
    Route::post('/profile', [UserController::class, "update"]);
    Route::delete('/{id}', [UserController::class, "destroy"]);

    //Friend
    Route::group([
        'prefix' => 'friends',
    ], function () {
        Route::get('/', [FriendController::class, "index"]);
        Route::post('/', [FriendController::class, "store"]);
        Route::delete('/', [FriendController::class, "destroy"]);
    });
});

//Post
Route::group([
    'prefix' => 'api/posts',
    'middleware' => 'auth',
], function () {
    Route::get('/', [PostController::class, "index"]);
    Route::get('/{id}', [PostController::class, "show"]);
    Route::post('/', [PostController::class, "store"]);
    Route::patch('/{id}', [PostController::class, "update"]);
    Route::patch('/{id}/like', [PostController::class, "like"]);
    Route::delete('/{id}', [PostController::class, "destroy"]);
    Route::delete('/{id}/like', [PostController::class, "unlike"]);
});

//Group
Route::group([
    'prefix' => 'api/groups',
    'middleware' => 'auth',
], function () {
    Route::get('/', [GroupController::class, "index"]);
    Route::get('/{id}', [GroupController::class, "show"]);
    Route::post('/', [GroupController::class, "store"]);
    Route::patch('/{id}', [GroupController::class, "update"]);
    Route::delete('/{id}', [GroupController::class, "destroy"]);
    Route::group([
        'prefix' => 'users',
    ], function () {
        Route::get('/', [GroupUserController::class, "index"]);
        Route::get('/{user_id}', [GroupUserController::class, "show"]);
        Route::post('/', [GroupUserController::class, "store"]);
        Route::patch('/{user_id}', [GroupUserController::class, "update"]);
        Route::delete('/{user_id}', [GroupUserController::class, "destroy"]);
    });
});

//Room
Route::group([
    'prefix' => 'api/rooms',
    'middleware' => 'auth',
], function () {
    Route::get('/', [RoomController::class, "index"]);
    Route::get('/{id}', [RoomController::class, "show"]);
    Route::post('/', [RoomController::class, "store"]);
    Route::patch('/{id}', [RoomController::class, "update"]);
    Route::delete('/{id}', [RoomController::class, "destroy"]);
    Route::group([
        'prefix' => 'users',
    ], function () {
        Route::get('/', [RoomUserController::class, "index"]);
        Route::get('/{id}', [RoomUserController::class, "show"]);
        Route::post('/', [RoomUserController::class, "store"]);
        Route::patch('/{id}', [RoomUserController::class, "update"]);
        Route::delete('/{id}', [RoomUserController::class, "destroy"]);
    });
});
