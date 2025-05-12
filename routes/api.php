<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\ProjectsController;
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

Route::post('auth/tokens',[]);
