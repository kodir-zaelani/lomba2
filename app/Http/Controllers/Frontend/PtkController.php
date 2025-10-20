<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Ptk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PtkController extends Controller
{
    public $segment;
    protected $limit = 3;
    public function index(){
        return view('frontend.ptk.index',[
            'ptk' => Ptk::paginate($this->limit),
            'title' => 'PTK'
        ]);
    }
}