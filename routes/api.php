<?php

use App\Http\Controllers\API\DepartmentController;
use App\Http\Controllers\API\DokterController;
use App\Http\Controllers\API\SpesialisController;
use App\View\Components\myPage\department;
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

Route::resource('department', DepartmentController::class);
Route::post('/department/{id}', [DepartmentController::class,'update']);

Route::resource('spesialis', SpesialisController::class);
Route::post('/spesialis/{id}', [SpesialisController::class,'update']);

// Route::resource('dokter', DokterController::class);
// Route::post('/dokter/{id}', [DokterController::class,'update']);
// Route::get('/department', [DepartmentController::class,'departmentList']);
