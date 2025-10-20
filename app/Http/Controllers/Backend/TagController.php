<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
    * __construct
    *
    * @return void
    */

     public static function middleware(): array
    {
        return [
            'permission:tags.index|tags.create|tags.edit|tags.delete|tags.trash',
        ];
    }

    public function index()
    {
        return view('backend.tag.index');
    }
}
