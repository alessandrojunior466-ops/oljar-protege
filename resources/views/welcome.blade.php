@auth
    @if(auth()->user()->role === 'admin')
        <a href="{{ url('/admin/dashboard/blog') }}">Blog</a>
    @else
        <a href="{{ route('extras') }}">Conteúdos Exclusivos</a>
    @endif
@else
    <a href="{{ route('extras.login') }}">Blog</a>
@endauth