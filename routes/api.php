<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BlogApiController;
use App\Http\Controllers\Api\VideosApiController;

// Rota de Usuário
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Rotas da API de Blog (Públicas para leitura)
Route::get('/blog', [BlogApiController::class, 'index']);
Route::get('/blog/{id}', [BlogApiController::class, 'show']);

// Rotas da API de Vídeos (Públicas para leitura)
Route::get('/videos', [VideosApiController::class, 'index']);
Route::get('/videos/{id}', [VideosApiController::class, 'show']);

// Rotas Protegidas com Sanctum para escrita (Blog e Vídeos)
Route::middleware('auth:sanctum')->group(function () {
    // Blog
    Route::post('/blog', [BlogApiController::class, 'store']);
    Route::put('/blog/{id}', [BlogApiController::class, 'update']);
    Route::delete('/blog/{id}', [BlogApiController::class, 'destroy']);

    // Vídeos
    Route::post('/videos', [VideosApiController::class, 'store']);
    Route::put('/videos/{id}', [VideosApiController::class, 'update']);
    Route::delete('/videos/{id}', [VideosApiController::class, 'destroy']);
});