<?php

namespace App\Livewire;

use Livewire\Component;

class CreatePost extends Component
{
    // public $nama;

    public $count = 0;

    public function increment()
    {
        $this->count++;
    }

    public function render()
    {
        return view('livewire.create-post');
    }
}
