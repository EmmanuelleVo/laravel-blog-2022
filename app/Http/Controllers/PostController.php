<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $posts = Post::with('comments', 'categories', 'user')->paginate('10'); //comments.user

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('posts.add-post');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(PostRequest $request)
    {
        $validated = $request->validated();


        if ($validated) {

            $post = Post::create([
                'title' => $validated['title'],
                'slug' => Str::slug($validated['title']),
                'excerpt' => $validated['excerpt'],
                'body' => $validated['body'],
                'user_id' => auth()->user()->id,
            ]);

            $post_id = $post->id;

            foreach ($validated['post-category'] as $category_id) {
                DB::table('category_post')->insert(compact('category_id', 'post_id'));
            }

            return redirect('/posts/' . Str::slug($validated['title']));
        }

        return back()->withInput();

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(Post $post)
    {
        $post->load('comments', 'categories', 'user');

        return view('posts.post', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function edit(Post $post)
    {
        //$post = Post::where('slug', $slug)->first();
        $post->load('categories');

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(PostRequest $request, Post $post)
    {
        $validated = $request->validated();

        $post_id = $post->id;

        if ($validated) {
            $post->update([
                'title' => $validated['title'],
                'slug' => Str::slug($validated['title']),
                'excerpt' => $validated['excerpt'],
                'body' => $validated['body'],
                'user_id' => auth()->user()->id,
            ]);


            foreach ($validated['post-category'] as $category_id) {
                //dd($category_id);

                DB::table('category_post')->where('post_id', $post_id)->update(compact('category_id'));
            }

            return redirect('/posts/' . Str::slug($validated['title']));
        }

        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect('/posts');
    }
}
