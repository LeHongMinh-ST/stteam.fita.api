<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware(['auth:api'])->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', [AuthController::class, 'me']);
    });

    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->middleware('permission:user-index');
        Route::post('/', [UserController::class, 'store'])->middleware('permission:user-create');
        Route::get('/{id}', [UserController::class, 'show'])->middleware('permission:user-read');
        Route::put('/{id}', [UserController::class, 'update'])->middleware('permission:user-update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->middleware('permission:user-delete');
    });

    Route::prefix('roles')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->middleware('permission:role-index');
        Route::post('/', [RoleController::class, 'store'])->middleware('permission:role-create');
        Route::get('/{id}', [RoleController::class, 'show'])->middleware('permission:role-read');
        Route::put('/{id}', [RoleController::class, 'update'])->middleware('permission:role-update');
        Route::delete('/{id}', [RoleController::class, 'destroy'])->middleware('permission:role-delete');
    });

    Route::prefix('permissions')->group(function () {
        Route::get('/', [PermissionController::class, 'index'])->middleware('permission:role-index');
        Route::get('/group', [PermissionController::class, 'getGroupPermission'])
            ->middleware('permission:role-index');
    });

});
