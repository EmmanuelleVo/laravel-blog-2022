<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SelectOrderDate extends Component
{
    public $options;
    public $sortOrder;

    public function mount()
    {
        $this->options = ['Latest', 'Oldest'];
        $this->sortOrder = $this->options[0];
    }

    public function updatedByDate()
    {
        $this->emit('byDateUpdated', $this->sortOrder);
    }

    public function render()
    {
        return view('livewire.select-order-date');
    }
}
