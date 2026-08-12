<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    // Define explicitamente o nome da tabela no banco de dados
    protected $table = 'videos';

    protected $fillable = [
        'titulo',
        'descricao',
        'arquivo',
        'user_id',
    ];

    /**
     * Relacionamento com o usuário/autor
     */
    public function autor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}