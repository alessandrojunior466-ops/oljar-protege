<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blogs';

    protected $fillable = [
    'titulo',
    'conteudo',
    'imagem',
    'youtube_url',
    'user_id',
];

    /**
     * Relacionamento com o usuário criador da publicação
     */
    public function autor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}