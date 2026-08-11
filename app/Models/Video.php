<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descricao',
        'arquivo',
        'user_id', // garante que a chave do autor possa ser gravada
    ];

    /**
     * Relacionamento com o usuário criador do vídeo
     */
    public function autor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}