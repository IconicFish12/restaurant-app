<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;

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
Route::get('/administrator', [DashboardController::class, 'dashboardView'])->middleware('auth');

