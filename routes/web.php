<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuController;

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
//AUTH ROUTE
Route::prefix('login')->name('login')->middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'loginView']);
    Route::post('/', [AuthController::class, 'auth']);
});

Route::prefix('registration')->group(function() {
    Route::get('/',  [AuthController::class, 'registerView']);
    Route::post('/register', [AuthController::class, 'registerAction']);
});

Route::get('logout', [AuthController::class, 'logout']);

//DASHBOARD VIEW / BACKEND SYSTEM
Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'dashboardView']);

    Route::prefix('/menus')->group(function(){
        Route::get('/', [MenuController::class, 'index']);
        Route::post('/', [MenuController::class, 'store']);
        Route::get('/{menu:id}', [MenuController::class, 'show']);
        Route::put('/{menu:id}', [MenuController::class, 'update']);
        Route::delete('/{menu:id}', [MenuController::class, 'destroy']);
    });

    Route::prefix('/categories')->group(function(){
        Route::get('/', [CategoryController::class, 'index']);
        Route::post('/', [CategoryController::class, 'store']);
        Route::get('/{category:id}', [CategoryController::class, 'show']);
        Route::put('/{category:id}', [CategoryController::class, 'update']);
        Route::delete('/{category:id}', [CategoryController::class, 'destroy']);
    });
});

Route::prefix('/home')->middleware('auth')->group(function(){
    Route::get('/', [DashboardController::class, 'webView']);
});
