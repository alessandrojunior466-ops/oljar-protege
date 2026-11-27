<div {{ $attributes->merge(['class' => 'w-full overflow-hidden rounded-lg']) }} style="width: 100%; aspect-ratio: 16 / 9;">
    <iframe
        style="width: 100%; height: 100%; border: 0; display: block;"
        src="https://www.youtube-nocookie.com/embed/{{ $videoId }}"
        title="YouTube video player"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
        referrerpolicy="strict-origin-when-cross-origin"
        allowfullscreen
    ></iframe>
</div>