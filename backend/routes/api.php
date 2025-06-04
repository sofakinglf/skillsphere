<?php
use App\Http\Controllers\AppliedWorkController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\UserController;
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
Route::post('/register', [UserController::class, 'store']);

Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth.token')->group(function () {
    Route::get('/get-task-details/{id}', [MasterController::class, 'details']);
    Route::post('/tasks', [MasterController::class, 'store']);
    Route::get('/get-tasks', [MasterController::class, 'index']);
    Route::get('/get-my-project', [MasterController::class, 'myProject']);
    Route::get('/get-applied-project', [MasterController::class, 'AppliedList']);

    Route::post('/store-proposal', [AppliedWorkController::class, 'store']);
    Route::get('/get-applicants/{id}', [AppliedWorkController::class, 'index']);
    Route::get('/check-application-status/{id}', [AppliedWorkController::class, 'checkApplication']);


});
