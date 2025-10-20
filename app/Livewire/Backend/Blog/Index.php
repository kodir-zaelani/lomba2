<?php

namespace App\Livewire\Backend\Blog;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.backend.blog.index',[
            'title_page' => 'Blog'
        ]);
    }
}
