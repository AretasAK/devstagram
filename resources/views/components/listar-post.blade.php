<div>
    @if ($posts->count())

    <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-10">

        @foreach ($posts as $post)

        <div>

            <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user]) }}">
                <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{ $post->titulo }}">
            </a>
            <div class="flex items-center justify-between m-2">
                <h3 class="text-sm italic"> <span class="font-bold ">{{ $post->user->username }}:</span> ha publicado
                    hace {{ $post->created_at->diffForHumans() }}</h3>

                <div>
                    <h5 class="font-bold text-sm">{{ $post->likes->count() }} <span class=" font-normal text-sm">
                            Likes</span></h5>
                    <h5 class="font-bold text-sm">{{ $post->comentarios->count() }}<span class=" font-normal text-sm">
                            @choice('Comentario|Comentarios', $post->comentarios->count())</span></h5>
                </div>
            </div>

        </div>

        @endforeach
    </div>

    <div class="my-10">
        {{ $posts->links() }}
    </div>

    @else
    <p class="text-cente">No hay posts, sigue a alguien para poder mostrar sus posts.</p>
    @endif

</div>