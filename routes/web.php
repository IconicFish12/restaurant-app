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
Route::get('/login', [AuthController::class, 'loginView'])->middleware('guest');
Route::get('/register', [AuthController::class, 'regiterView']);
Route::post('/authenticate', );

//DASHBOARD VIEW / BACKEND SYSTEM
Route::get('/', [DashboardController::class, 'dashboardView']);

