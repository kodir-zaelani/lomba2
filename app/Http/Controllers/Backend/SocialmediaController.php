<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SocialmediaController extends Controller
{
     /**
    * __construct
    *
    * @return void
    */

     public static function middleware(): array
    {
        return [
            'permission:socialmedia.index|socialmedia.create|socialmedia.edit|socialmedia.delete|socialmedia.trash',
        ];
    }

    public function index()
    {
        return view('backend.socialmedia.index');
    }
}
