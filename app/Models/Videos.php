<?php

namespace App\Models;

/**
 * Classe alias para permitir a execução de queries no plural,
 * como: App\Models\Videos::all(); no Tinker.
 */
class Videos extends Video
{
}