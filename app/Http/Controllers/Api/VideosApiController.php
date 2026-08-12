<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideosApiController extends Controller
{
    /**
     * Listar todos os vídeos (http://127.0.0.1:8000/api/videos)
     */
    public function index()
    {
        $videos = Video::latest()->get();

        return response()->json([
            'success' => true,
            'data' => $videos
        ], 200);
    }

    /**
     * Exibir um vídeo específico por ID (http://127.0.0.1:8000/api/videos/{id})
     */
    public function show($id)
    {
        $video = Video::find($id);

        if (!$video) {
            return response()->json([
                'success' => false,
                'message' => 'Vídeo não encontrado'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $video
        ], 200);
    }
}