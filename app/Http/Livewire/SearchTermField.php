<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SearchTermField extends Component
{
    public $searchTerm;

    public function updatedSearchTerm()
    {
        $this->emit('searchTermUpdated', $this->searchTerm);
    }

    public function render()
    {
        return view('livewire.search-term-field');
    }
}
