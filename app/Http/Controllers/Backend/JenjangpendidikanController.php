<?php

namespace App\Http\Controllers\Backend;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JenjangpendidikanController extends Controller
{
    /**
    * __middleware
    *
    * @return void
    */

    public static function middleware(): array
    {
        return [
            // examples with aliases, pipe-separated names, guards, etc:
            'permission:jenjang pendidikan.index|jenjang pendidikan.create|jenjang pendidikan.edit|jenjang pendidikan.delete|jenjang pendidikan.trash',
        ];
    }
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(): View
    {
        return view('backend.jenjangpendidikan.index', [
            'title' => 'Jenjang Pendidikan'
        ]);
    }
}
