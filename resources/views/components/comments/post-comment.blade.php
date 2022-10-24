<article class="flex space-x-4">
    <div class="flex-shrink-0">
        <img src="https://i.pravatar.cc/60?u={{ $comment->author->id }}" alt="" width="60" height="60" class="rounded-xl">
    </div>
    <div>
        <header class="mb-4">
            <h3 class="font-bold">{{ $comment->author->username }}</h3>
            <p class="text-xs">Posted on <time datetime="{{ $comment->created_at }}">{{ $comment->created_at->format(' dS M. Y ') }} at {{ $comment->created_at->format(' h:i ') }}</time>
        </header>
        <p>{{ $comment->body }}</p>
    </div>
</article>
