<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BlogApiController;

// Rota de Usuário
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Rotas da API de Blog (Públicas para leitura / Protegidas com Sanctum para escrita)
Route::get('/blogs', [BlogApiController::class, 'index']);
Route::get('/blogs/{id}', [BlogApiController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/blogs', [BlogApiController::class, 'store']);
    Route::put('/blogs/{id}', [BlogApiController::class, 'update']);
    Route::delete('/blogs/{id}', [BlogApiController::class, 'destroy']);
});