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
        'user_id', // garante que a chave do autor possa ser gravada
    ];

    /**
     * Relacionamento com o usuário criador da publicação
     */
    public function autor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}