<?php

use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\ApiController;
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
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [ApiAuthController::class, 'register']);
Route::post('login', [ApiAuthController::class, 'login']);

//GET ROUTE
Route::middleware('auth:sanctum')->group(function(){
    Route::get('getCategory', [ApiController::class, "getCategory"]);
    Route::get('getTable', [ApiController::class, "getTable"]);
    Route::get('getMenu-1', [ApiController::class, "getMenuWithcategory"]);
    Route::get('getMenu-2', [ApiController::class, "getMenu"]);
}
);
