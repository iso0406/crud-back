<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ExpenseController;


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

Route::group(['prefix' => 'auth'], function(){
	Route::post('login', [AuthController::class, 'login']);
	Route::post('register', [AuthController::class, 'register']);

	Route::group(['middleware' => 'apiJWT'], function(){
		Route::post('logout', [AuthController::class, 'logout']);
	});
});

Route::group(['middleware' => 'apiJWT'], function(){
	Route::group(['prefix' => 'expense'], function(){
		Route::get('/', [ExpenseController::class, 'index']);
		Route::post('/register', [ExpenseController::class, 'store']);
		Route::put('/{id}', [ExpenseController::class, 'update']);
		Route::get('/{id}', [ExpenseController::class, 'show']);
		Route::delete('/{id}', [ExpenseController::class, 'destroy']);
	});

	Route::group(['prefix' => 'user'], function(){
		Route::get('/', [UserController::class, 'index']);
		Route::get('/{id}', [UserController::class, 'show']);
	});
});