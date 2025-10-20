<?php

namespace App\Http\Controllers\Backend;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BentukpendidikanController extends Controller
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
            'permission:bentuk pendidikan.index|bentuk pendidikan.create|bentuk pendidikan.edit|bentuk pendidikan.delete|bentuk pendidikan.trash',
        ];
    }
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(): View
    {
        return view('backend.bentukpendidikan.index', [
            'title' => 'Bentuk Pendidikan'
        ]);
    }
}
