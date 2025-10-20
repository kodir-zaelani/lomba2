<?php

namespace App\Http\Controllers\Backend;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TingkatpendidikanController extends Controller
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
            'permission:tingkat pendidikan.index|tingkat pendidikan.create|tingkat pendidikan.edit|tingkat pendidikan.delete|tingkat pendidikan.trash',
        ];
    }
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(): View
    {
        return view('backend.tingkatpendidikan.index', [
            'title' => 'Tingkat Pendidikan'
        ]);
    }
}
