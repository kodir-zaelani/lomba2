<?php

namespace App\Http\Controllers\Backend;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KebutuhankhususController extends Controller
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
            'permission:kebutuhan khusus.index|kebutuhan khusus.create|kebutuhan khusus.edit|kebutuhan khusus.delete|kebutuhan khusus.trash',
        ];
    }
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(): View
    {
        return view('backend.kebutuhankhusus.index', [
            'title' => 'Kebutuhan Khusus'
        ]);
    }
}