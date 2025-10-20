<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
    * __construct
    *
    * @return void
    */
    // public function __construct()
    // {
    //     $this->middleware(['permission:dashboard.index']);
    // }

    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */
    public function index()
    {
        return view('backend.home.index', [
            'title' => 'Dashboard'
        ]);
    }
}