<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Items (optional)
Route::get('/items', [ItemController::class, 'index']);
Route::post('/items', [ItemController::class, 'store']);

// Companies (for the dropdown)
Route::get('/companies', [UserController::class, 'companies']);

// Auth: register and login (POST)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// (Optional) GET current user if you later protect it with sanctum
// Route::middleware('auth:sanctum')->get('/user', function(Request $request) {
//     return $request->user();
// });
