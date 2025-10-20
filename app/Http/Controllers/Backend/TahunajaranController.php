<?php

namespace App\Http\Controllers\Backend;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TahunajaranController extends Controller
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
            'permission:tahun ajaran.index|tahun ajaran.create|tahun ajaran.edit|tahun ajaran.delete|tahun ajaran.trash',
        ];
    }
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(): View
    {
        return view('backend.tahunajaran.index', [
            'title' => 'Tahun Ajaran'
        ]);
    }
}
