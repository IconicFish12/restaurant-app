<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PerformanceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\WebController;

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

Route::prefix('attendance')->name('attendance')->middleware('guest')->group(function(){
    Route::get('/', [AuthController::class, 'attendanceView']);
    Route::post('/action', [AuthController::class, 'attendanceAction']);
});

Route::prefix('registration')->group(function() {
    Route::get('/',  [AuthController::class, 'registerView']);
    Route::post('/register', [AuthController::class, 'registerAction']);
});

Route::get('logout', [AuthController::class, 'logout'])->middleware("auth:web,employee");

Route::get('forgot', [ResetPasswordController::class, "forgotView"])->middleware('guest');
Route::post('forgotAction', [ResetPasswordController::class, "forgotAction"])->middleware("guest");
Route::get('reset-password/{token}', [ResetPasswordController::class, "resetView"])->middleware("guest");
Route::post('reset-password-action', [ResetPasswordController::class, "resetAction"])->middleware("guest");

//DASHBOARD VIEW / BACKEND SYSTEM
Route::prefix('/webistrator')->middleware(['role:web', 'attend'])->group(function(){

    Route::get('/',[DashboardController::class, 'dashboardView'])->middleware(['auth:web,employee']);

    Route::prefix('/menus')->middleware(['auth:web', 'role:web'])->group(function(){
        Route::get('/', [MenuController::class, 'index']);
        Route::post('/', [MenuController::class, 'store']);
        Route::get('/{menu:id}', [MenuController::class, 'show']);
        Route::put('/{menu:id}', [MenuController::class, 'update']);
        Route::delete('/{menu:id}', [MenuController::class, 'destroy']);
    });

    Route::prefix('/categories')->middleware(['auth:web', 'role:web'])->group(function(){
        Route::get('/', [CategoryController::class, 'index']);
        Route::post('/', [CategoryController::class, 'store']);
        Route::get('/{category:id}', [CategoryController::class, 'show']);
        Route::put('/{category:id}', [CategoryController::class, 'update']);
        Route::delete('/{category:id}', [CategoryController::class, 'destroy']);
    });

    Route::prefix('/tables')->middleware('auth:web,employee')->group(function() {
        Route::get('/', [TableController::class, 'index']);
        Route::post('/', [TableController::class, 'store']);
        Route::get('/{table:id}', [TableController::class, 'show']);
        Route::put('/{table:id}', [TableController::class, 'update']);
        Route::delete('/{table:id}', [TableController::class, 'destroy']);
    });

    // USER AND EMPLOYEE MANAGEMENT
    Route::prefix('/users')->middleware(['auth:web', 'role:web'])->group(function() {
        Route::get('/', [UserController::class, 'index']);
        Route::post('/', [UserController::class, 'store']);
        Route::get('/{user:id}', [UserController::class, 'show']);
        Route::put('/{user:id}', [UserController::class, 'update']);
        Route::delete('/{user:id}', [UserController::class, 'destroy']);
    });

    Route::prefix('/employees')->middleware(['auth:web', 'role:web'])->group(function () {
        Route::get('/', [EmployeeController::class, 'index']);
        Route::post('/', [EmployeeController::class, 'store']);
        Route::get('/{employee:id}', [EmployeeController::class, 'show']);
        Route::put('/{employee:id}', [EmployeeController::class, 'update']);
        Route::delete('/{employee:id}', [EmployeeController::class, 'destroy']);
    });

    //CONTACT SERVICE
    Route::prefix('/messages')->middleware(['auth:web', 'role:web'])->group(function (){
        Route::get('/', [ContactController::class, 'index']);
        Route::post('/', [ContactController::class, 'store']);
        Route::get('/{contact:id}', [ContactController::class, 'show']);
        Route::delete('/{contact:id}', [ContactController::class, 'destroy']);
    });

    //TRANSACTION ACTIVITY
    Route::prefix('/orders')->middleware(['auth:web', 'role:web'])->group(function(){
        Route::get('/', [OrderController::class, 'index']);
        Route::post('/', [OrderController::class, 'store']);
        Route::get('/{order:id}', [OrderController::class, 'show']);
        Route::put('/{order:id}', [OrderController::class, 'update']);
        Route::delete('/{order:id}', [OrderController::class, 'destroy']);
    });

    Route::prefix('/histories')->middleware(['auth:web', 'role:web'])->group(function(){
        Route::get('/', [OrderController::class, 'orderHistory']);
    });

    Route::prefix('/vouchers')->middleware(['auth:web', 'role:web'])->group(function() {
        Route::get('/', [VoucherController::class, 'index']);
        Route::post('/', [VoucherController::class, 'store']);
        Route::get('/{voucher:id}', [VoucherController::class, 'show']);
        Route::put('/{voucher:id}', [VoucherController::class, 'update']);
        Route::delete('/{voucher:id}', [VoucherController::class, 'destroy']);
    });

    //PAYMENT MANAGEMENT


    //EMPLOYEE PERFORMANCE
    Route::prefix('/performances')->middleware('auth:web,employee')->group(function () {
        Route::get('/', [PerformanceController::class, 'index']);
        Route::post('/', [PerformanceController::class, 'store']);
        Route::get('/{performance:id}', [PerformanceController::class, 'show']);
        Route::put('/{performance:id}', [PerformanceController::class, 'update']);
        Route::delete('/{performance:id}', [PerformanceController::class, 'destroy']);
    });

    Route::prefix('/works')->middleware('auth:web,employee')->group(function (){
        Route::get('/', [WorkController::class, 'index']);
        Route::post('/', [WorkController::class, 'store']);
        Route::get('/{work:id}', [WorkController::class, 'show']);
        Route::put('/{work:id}', [WorkController::class, 'update']);
        Route::delete('/{work:id}', [WorkController::class, 'destroy']);
    });

    //PROFILE MANAGEMENT
    Route::get('/me', [ProfileController::class, 'index'])->middleware(['auth:web', 'role:web']);

    //MORE
    Route::middleware(['auth:web', 'role:web'])->group(function(){
        Route::get('/backup', [BackupController::class, 'index']);
        Route::get('/backup/create', [BackupController::class, 'store']);
        Route::delete('/backup/delete/{i}', [BackupController::class, 'destroy']);
    });

    Route::get('/documentation', [DashboardController::class, 'documentation'])->middleware(['auth:web', 'role:web']);

    Route::prefix('/attendances-data')->group(function(){
        Route::get('/', [AttendanceController::class, 'index']);
        Route::middleware(['auth:web', 'role:web'])->group(function(){
            Route::post('/', [AttendanceController::class, 'store']);
            Route::get('/{attendance:id}', [AttendanceController::class, 'show']);
            Route::put('/{attendance:id}', [AttendanceController::class, 'update']);
            Route::delete('/{attendance:id}', [AttendanceController::class, 'destroy']);
        });
    });
});

//WEB VIEW
Route::get('/', [WebController::class, 'webView'])->middleware("guest");
Route::get('/menus', [WebController::class, 'menuView'])->middleware('guest');
Route::get('/home', [WebController::class, 'webView'])->middleware(['auth', "role:costumer"]);
Route::post('/messages', [ContactController::class, 'store']);

