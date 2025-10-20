<?php

namespace App\Livewire\Backend\Post;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public function render()
    {
        return view('livewire.backend.post.index',[
            'title_page' => 'Posts'
        ]);
    }
}
