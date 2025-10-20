<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Blog;
use App\Models\Postcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{

    protected $limit = 6;
    public function index()
    {
        return view('frontend.blog.index', [
            'blogs' => Blog::with('blogcategory', 'tags', 'author')
            ->Published()
            ->Publishedate()
            ->latest()
            ->paginate($this->limit),
            'title' => 'Semua Blog'
        ]);
    }

    public function detail($slug, Blog $blog) {

        $blog->increment('view_count');

        return view('frontend.blog.detail', [
            'blog' => Blog::with('blogcategory', 'tags', 'author')->where('slug', $slug)->first(),
            'title' => 'Blog Detail'
        ]);
    }

    public function category(Request $request) {
        $this->segment = $request->segment(3);
        $blogcategory = Postcategory::where('slug', $this->segment)->first();
        $blogs = $blogcategory->blogs()
        ->published()
        ->publishedate()
        ->paginate($this->limit);


        return view('frontend.blog.category', [
            'blogs' => $blogs,
            'blogcategory' => $blogcategory,
            'title' => 'Blog Category'
        ]);
    }
}
