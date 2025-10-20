<?php

namespace App\Http\Controllers\Backend;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JenisptkController extends Controller
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
            'permission:jenis ptk.index|jenis ptk.create|jenis ptk.edit|jenis ptk.delete|jenis ptk.trash',
        ];
    }
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(): View
    {
        return view('backend.jenisptk.index', [
            'title' => 'Jenis PTK'
        ]);
    }
}
