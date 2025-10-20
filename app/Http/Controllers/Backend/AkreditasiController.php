<?php

namespace App\Http\Controllers\Backend;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AkreditasiController extends Controller
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
            'permission:akreditasi.index|akreditasi.create|akreditasi.edit|akreditasi.delete|akreditasi.trash',
        ];
    }
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(): View
    {
        return view('backend.akreditasi.index', [
            'title' => 'Akreditasi'
        ]);
    }
}