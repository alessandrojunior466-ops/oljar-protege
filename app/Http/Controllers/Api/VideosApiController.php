<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideosApiController extends Controller
{
    /**
     * Listar vídeos paginados com relacionamento (http://127.0.0.1:8000/api/videos)
     */
    public function index()
    {
        $videos = Video::latest()->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $videos
        ], 200);
    }

    /**
     * Cadastrar um novo vídeo (http://127.0.0.1:8000/api/videos)
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'arquivo' => 'nullable|string',
            'categoria_id' => 'nullable|integer',
        ]);

        $video = Video::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Vídeo criado com sucesso!',
            'data' => $video
        ], 201);
    }

    /**
     * Exibir um vídeo específico por ID (http://127.0.0.1:8000/api/videos/{id})
     */
    public function show($id)
    {
        $video = Video::with('categoria')->find($id);

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
