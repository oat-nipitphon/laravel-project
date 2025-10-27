<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| 1. php artisan install :api
| 2. create file api.php #path project/route/(filename.php)
| 3. config route install path bootstrap/app.php (withRouting)
|  ************************  Test Git Create Branch ***************************
*/

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MemberController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::apiResource('//member', MemberController::class)->middleware('auth:sanctum');

?>
