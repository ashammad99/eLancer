<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\ProjectsController;
use \App\Http\Controllers\Api\AuthTokenController;
use \App\Http\Middleware\CheckApiKey;
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

// GET /api/projects -> index
// POST /api/projects -> store
// GET  /api/projects/{project} -> show
// PUT|PATCH  /api/projects/{project} -> update
// DELETE  /api/projects/{project} -> destroy

Route::apiResource('projects', ProjectsController::class);

Route::get('auth/current-token', [AuthTokenController::class, 'show'])
    ->middleware(['auth:sanctum']);
Route::get('auth/tokens', [AuthTokenController::class, 'index'])
    ->middleware(['auth:sanctum']);

Route::post('auth/tokens', [AuthTokenController::class, 'store'])
    ->middleware(['guest:sanctum']);

Route::delete('auth/tokens/{id}', [AuthTokenController::class, 'destroy'])
    ->middleware(['auth:sanctum']);

Route::get('/shams', function () {
    return "Hello Im Samoosa";
})->middleware(CheckApiKey::class);
