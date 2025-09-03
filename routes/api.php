<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FileUploadController;
use App\Http\Controllers\Api\MediaController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    // Route::get('/uploads', [FileUploadController::class, 'index']);
    // Route::post('/uploads', [FileUploadController::class, 'store']);
    // Route::put('/uploads/{fileUpload}', [FileUploadController::class, 'update']);
    // Route::delete('/uploads/{fileUpload}', [FileUploadController::class, 'destroy']);

    Route::post('/media-upload', [MediaController::class, 'upload']);
    Route::get('/media-list', [MediaController::class, 'list']);
    Route::delete('/media-delete/{id}', [MediaController::class, 'delete']);
    Route::put('/media-update/{id}', [MediaController::class, 'update']);

});


Route::get('/test', function () {
    return response()->json([
        'success' => true,
        'data' => [
            'oke' => 123,
            'dua'=> [1,2,3],
        ],
    ]);
});

Route::get('/server-time', function () {
    return response()->json([
        'time' => now()->setTimezone('Asia/Makassar')->toIso8601String()
    ]);
});

Route::get('/events', [\App\Http\Controllers\Api\AgendaController::class, 'index']);


Route::post('/save-player-id', function (Request $request) {
    $user = auth()->user();
    if ($user) {
        $user->update(['player_id' => $request->player_id]);
        return response()->json(['status' => 'saved']);
    }
    return response()->json(['error' => 'unauthenticated'], 401);
});
