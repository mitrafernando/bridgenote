<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\AuthController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('member', MemberController::class)->middleware('auth:sanctum');
Route::post('register', [AuthController::class, 'register']);
Route::post('registerWithGoogle', [AuthController::class, 'registerWithGoogle']);
Route::post('login', [AuthController::class, 'login']);

Route::fallback(function () {
    return response()->json([
        'message' => 'Not found'
    ], 404);
})->name('api.fallback');
