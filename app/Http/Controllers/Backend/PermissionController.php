<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
 /**
    * __construct
    *
    * @return void
    */

     public static function middleware(): array
    {
        return [
            'permission:permissions.index|permissions.create|permissions.edit|permissions.delete|permissions.trash',
        ];
    }

    public function index()
    {
        return view('backend.permission.index',[
            'title' => 'Backend - Permissions'
        ]);
    }
}