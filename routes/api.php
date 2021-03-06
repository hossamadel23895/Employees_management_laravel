<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserVacationController;
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

Route::controller(AuthController::class)->group(function () {
    Route::post('register', 'register')->name('register');
    Route::post('login', 'login')->name('login');
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('me', [AuthController::class, 'me'])->name('me');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::put('profile/change-password', [ ProfileController::class, 'changePassword' ])->name('profile.change-password');

});

Route::group(['middleware' => ['auth:sanctum','role:'.__('roles.admin')]], function () {
    Route::apiResource('users', UserController::class);
    Route::apiResource('users.vacations', UserVacationController::class);
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('types', TypeController::class);
});
