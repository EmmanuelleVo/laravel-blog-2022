<?php

namespace App\View\Components\Comments;

use App\Models\Post;
use Illuminate\View\Component;

class PostComment extends Component
{
    public $comments;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->comments = Post::with('comments');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.comments.post-comment');
    }
}
