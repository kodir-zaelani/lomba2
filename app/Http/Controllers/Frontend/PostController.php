<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use App\Models\Postcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{

    protected $limit = 6;
    public function postnews()
    {
        return view('frontend.post.postnews', [
            'posts' => Post::with('postcategory', 'tags', 'author')
            ->Published()
            ->Publishedate()
            ->latest()
            ->paginate($this->limit),
            'title' => 'Semua Berita'
        ]);
    }

    public function beritadetail($slug, Post $post) {

        $post->increment('view_count');

        return view('frontend.post.postdetail', [
            'post' => Post::with('postcategory', 'tags', 'author')->where('slug', $slug)->first(),
            'title' => 'Post Detail'
        ]);
    }

    public function postcategory(Request $request) {
        $this->segment = $request->segment(3);
        $postcategory = Postcategory::where('slug', $this->segment)->first();
        $posts = $postcategory->posts()
        ->published()
        ->publishedate()
        ->paginate($this->limit);


        return view('frontend.post.postcategory', [
            'posts' => $posts,
            'postcategory' => $postcategory,
            'title' => 'Post Category'
        ]);
    }
}
