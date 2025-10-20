<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class StatuskepemilikanController extends Controller
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
            'permission:status kepemilikan .index|status kepemilikan .create|status kepemilikan .edit|status kepemilikan .delete|status kepemilikan .trash',
        ];
    }
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(): View
    {
        return view('backend.statuskepemilikan.index', [
            'title' => 'Status Kepemilikan'
        ]);
    }
}