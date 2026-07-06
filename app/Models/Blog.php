<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    // Ajuste esses campos de acordo com as colunas que estão na sua migration create_blogs_table.php (ex: titulo, conteudo, imagem)
    protected $fillable = [
        'titulo',
        'conteudo',
    ];
}