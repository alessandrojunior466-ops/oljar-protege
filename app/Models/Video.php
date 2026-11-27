<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Video extends Model
{
    use HasFactory;

    protected $table = 'videos';

    protected $fillable = [
        'titulo',
        'descricao',
        'arquivo',
        'youtube_url',
        'thumbnail_url',
        'midias',
        'user_id',
        'categoria_id',
    ];

    protected $casts = [
        'midias' => 'array',
    ];

    /**
     * Relacionamento com o usuário/autor
     */
    public function autor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relacionamento com a categoria
     */
    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
}