<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;


class Posts extends Component
{
    use WithPagination;

    public $searchTerm;
    public $sortOrder;

    protected $listeners = [
        'searchTermUpdated' => 'updatePostsWithFilter',
        'byDateUpdated' => 'updatePostsByDate',
    ];

    public function mount()
    {
        $this->searchTerm = '';
        $this->sortOrder = 'DESC';
    }

    public function updatePostsWithFilter($searchTerm)
    {
        $this->searchTerm = $searchTerm;
        $this->resetPage();
    }

    public function updatePostsByDate($sortOrder)
    {
        $this->sortOrder = $sortOrder;
        $this->sortOrder = $this->sortOrder === 'Latest' ? 'ASC' : 'DESC';

    }

    public function render()
    {
        return view('livewire.posts', [
            'posts' => Post::query()
                ->where('title', 'like', '%' . $this->searchTerm . '%')
                ->orWhere('excerpt', 'like', '%' . $this->searchTerm . '%')
                ->join('users', 'users.id', '=', 'posts.user_id')
                ->orWhere('users.name', 'like', '%' . $this->searchTerm . '%')
                ->orderBy('published_at', $this->sortOrder)
                ->paginate(),
        ]);
    }
}
