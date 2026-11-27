<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blogs';

    protected $fillable = [
        'titulo',
        'conteudo',
        'imagem',
        'youtube_url',
        'midias',
        'user_id',
    ];

    protected $casts = [
        'midias' => 'array',
    ];

    /**
     * Relacionamento com o usuário criador da publicação
     */
    public function autor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}