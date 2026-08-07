<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    // Nome da tabela se for diferente do padrão em inglês
    protected $table = 'blogs'; 

    protected $fillable = [
        'titulo',
        'conteudo',
        'imagem',
    ];
}