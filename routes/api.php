<?php

use App\Http\Controllers\Api\BranchController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CurrencyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('auth/login',[AuthController::class,'login'])->name('login');
Route::post('auth/logout', [AuthController::class,'logout']);
Route::get('currency', [CurrencyController::class,'index']);
Route::post('currency/post', [CurrencyController::class,'store']);

Route::group(['prefix' => 'users'], function () {
    Route::get('show/{id}',[UserController::class,'show']);
    Route::post('store', [UserController::class,'store']);
    Route::delete('destroy/{id}', [UserController::class,'destroy']);
    Route::put('update/{id}', [UserController::class,'update']);

});

Route::get('getbranches',[BranchController::class,'fullReportbranches']);
Route::get('docs    ',[BranchController::class,'fullReportbranches']);

Route::apiResource('users', UserController::class);
Route::middleware(['auth:users'])->group(function () {
    Route::apiResource('brands', BrandController::class);
    Route::apiResource('branches', BranchController::class);

});

