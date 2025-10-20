<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Laravolt\Indonesia\Models\City;
use App\Http\Controllers\Controller;

class WilayahController extends Controller
{

     public static function middleware(): array
    {
        return [
            // examples with aliases, pipe-separated names, guards, etc:
            'permission:master wilayah.index',
        ];
    }
    /**
    * Get Wilayah Indonesia.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
       return view('backend.wilayah.index');
    }



}
