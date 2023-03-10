<?php

use App\Http\Controllers\EmployeeController;
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

Route::prefix('employee')->group(function () {
    Route::get('', [EmployeeController::class, 'index']);
    Route::post('', [EmployeeController::class, 'upload']);
    Route::get('{id}', [EmployeeController::class, 'show']);
    Route::delete('{id}', [EmployeeController::class, 'destroy']);
});
