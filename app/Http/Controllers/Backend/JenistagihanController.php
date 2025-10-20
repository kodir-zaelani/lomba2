<?php

namespace App\Http\Controllers\Backend;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JenistagihanController extends Controller
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
            'permission:jenistagihan.index|jenistagihan.create|jenistagihan.edit|jenistagihan.delete|jenistagihan.trash',
        ];
    }
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(): View
    {
        return view('backend.jenistagihan.index', [
            'title' => 'Jenis Tagihan'
        ]);
    }
}