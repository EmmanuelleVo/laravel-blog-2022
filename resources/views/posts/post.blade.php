<x-header></x-header>
<article class="w-full lg:w-10/12">
    @auth()
        <div class="">
            @can('update', $post)
                <a href="/posts/edit/{{$post->slug}}"
                   class="text-blue-500 hover:underline">
                    Edit post
                </a>
            @endcan
            @can('delete', $post)
                <form action="/posts/{{ $post->slug }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-block text-red-500 hover:underline">Delete post
                    </button>
                </form>
            @endcan

        </div>
    @endauth

    <div class="flex items-center justify-between">
        <h2 class="text-xl font-bold text-gray-700 md:text-2xl">{{ $post->title }}</h2>
    </div>
    <div class="mt-6">
        <div class="max-w-4xl px-10 py-6 mx-auto bg-white rounded-lg shadow-md">
            <div class="flex items-center justify-between">
                <a href="/authors/{{ $post->user->slug }}"
                   class="flex items-center justify-end"><img
                        src="{{ $post->user->avatar }}"
                        alt="avatar"
                        class="hidden object-cover w-10 h-10 mr-4 rounded-full sm:block">
                    <span
                        class="font-bold text-gray-700 hover:underline">{{ ucwords($post->user->name) }}</span>
                </a>
                @foreach ($post->categories as $category)
                    <a href="/categories/{{ strtolower($category->slug) }}"
                       class="px-2 py-1 font-bold text-gray-100 bg-gray-600 rounded hover:bg-gray-500">{{ ucwords($category->name) }}</a>
                @endforeach
            </div>
            <div class="my-4">
                <span class="font-light text-gray-600">
                    {{ $post->published_at }}
                </span>
            </div>
            <div class="mt-2 text-gray-600">
                {!! $post->body !!}
            </div>
        </div>
    </div>
    <div class="mt-6">
        <div class="max-w-4xl px-10 py-6 mx-auto bg-white rounded-lg shadow-md">
            <h3 class="text-l font-bold text-gray-700 md:text-2xl">Comments : </h3>

            @auth()
                <form action="/posts/{{$post->slug}}/comments" method="POST">
                    @csrf

                    <header class="flex items-center">
                        <img src="https://i.pravatar.cc/60?u={{ $post->user_id }}" alt="" width="40"
                             height="40" class="rounded-full">
                        <h3 class="ml-4">Want to participate?</h3>
                    </header>

                    <div class="mt-6">
                        <label for="body"
                               class="block mb-2 mt-8 @error('body') text-red-600 @enderror">Write your comment</label>
                        @error('body')
                        <div class="text-red-600 py-1">{{ $message }}</div>
                        @enderror
                        <textarea id="body"
                                  name="body"
                                  rows="5"
                                  class="p-4 w-full rounded-md shadow-sm @error('body') outline outline-red-400 @enderror focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{old('body')}}</textarea>
                    </div>

                    <div class="flex justify-end pt-6 mt-6 border-t border-gray-200">
                        <button type="submit"
                                class=" mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md">
                            Send
                        </button>
                    </div>
                </form>
            @else
                <p class="font-semibold text-center">
                    <a href="../register"
                       class="transition-colors duration-300 hover:text-blue-500 hover:underline">Register</a>
                    or
                    <a href="../login"
                       class="transition-colors duration-300 hover:text-blue-500 hover:underline">Log in</a> to
                    leave a comment.
                </p>
            @endauth

            <ul>
                @foreach($post->comments as $comment)
                    <li>{{ $comment->body }}</li>

                @endforeach
            </ul>
        </div>
    </div>
</article>
<x-footer></x-footer>
</div>

</body>
</html>
