<?php

use App\Http\Controllers\EmployeeController;
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


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    //     return $request->user();
    // });
    
    Route::post('employee-create', [EmployeeController::class, 'register'])->name('employee-create');
    Route::post('employee-login', [EmployeeController::class, 'login'])->middleware('throttle.login');
    Route::middleware('auth:api')->group(function () {
        Route::get('/employee', [EmployeeController::class, 'show']);
    });