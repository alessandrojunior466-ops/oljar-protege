<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class YouTubeEmbed extends Component
{
    public string $videoId;

    /**
     * Create a new component instance.
     */
    public function __construct(string $url)
    {
        $this->videoId = $this->extractVideoId($url);
    }

    /**
     * Extrai o ID de 11 caracteres de URLs padrão, shorts, embed ou links curtos do YouTube.
     */
    private function extractVideoId(string $url): string
    {
        if (preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/|shorts\/)|youtu\.be\/)([A-Za-z0-9_-]{11})/', $url, $matches)) {
            return $matches[1];
        }

        return $url;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.you-tube-embed');
    }
}