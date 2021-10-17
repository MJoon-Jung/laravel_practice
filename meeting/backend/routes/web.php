no-unused-vars<?php

use App\Domains\Group\Controller\GroupController;
use App\Domains\Post\Controller\PostController;
use App\Domains\Room\Controller\RoomController;
use App\Domains\User\Controller\AuthController;
use App\Domains\User\Controller\FriendController;
use App\Domains\User\Controller\UserController;
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
    Route::get('/info', [UserController::class, "info"]);
    //Friend
    Route::group([
        'prefix' => 'friends',
    ], function () {
        Route::get('/', [FriendController::class, "index"]);
        Route::post('/{id}', [FriendController::class, "store"]);
        Route::delete('/{id}', [FriendController::class, "destroy"]);
    });
    Route::get('/{id}', [UserController::class, "show"]);
    Route::post('/profile/image', [UserController::class, "image"]);
    Route::patch('/profile', [UserController::class, "updateProfile"]);
    Route::delete('/', [UserController::class, "destroy"]);
});

//Post
Route::group([
    'prefix' => 'api/posts',
    'middleware' => 'auth',
], function () {
    Route::get('/', [PostController::class, "index"]);
    Route::get('/{id}', [PostController::class, "show"]);
    Route::post('/', [PostController::class, "store"]);
    Route::post('/image', [PostController::class, "image"]);
    Route::patch('/{id}/like', [PostController::class, "like"]);
    Route::patch('/{id}', [PostController::class, "update"]);
    Route::delete('/{id}/like', [PostController::class, "unlike"]);
    Route::delete('/{id}', [PostController::class, "destroy"]);
});

//Group
Route::group([
    'prefix' => 'api/groups',
    'middleware' => 'auth',
], function () {
    Route::get('/', [GroupController::class, "index"]);
    Route::get('/{id}', [GroupController::class, "show"]);
    Route::post('/', [GroupController::class, "store"]);
    Route::middleware(['group.exist', 'group.leader'])->group(function () {
        Route::patch('/{id}', [GroupController::class, "update"]);
        Route::patch('/{id}/invite/{userId}', [GroupController::class, "invite"])->middleware('group.not.member');
        Route::delete('/{id}', [GroupController::class, "destroy"]);
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
