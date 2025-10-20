<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use NguyenHuy\Menu\Models\MenuItems;

class MenuController extends Controller
{
    public function index()
    {
        return view('backend.menu.index',[
            'title' => 'Manajemen Menu ',
        ]);
    }

}
