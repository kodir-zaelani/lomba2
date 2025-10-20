<?php

namespace App\Http\Controllers\Backend;

use App\Models\Dukungan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RequestDukunganStore;
use App\Http\Requests\RequestDukunganUpdate;
use Intervention\Image\Laravel\Facades\Image;

class DukunganController extends Controller
{
    public function index()
    {
        return view('backend.dukungan.index',[
            'title' => 'Dukungan',
        ]);
    }

    public function create()
    {
        return view('backend.dukungan.create',[
            'title' => 'Dukungan Create',
        ]);
    }

    public function store(RequestDukunganStore $request)
    {
        // Default data
        $data = [
            'title'              => $request->input('title'),
            'slug'               => Str::slug($request->input('title')),
            'content'            => $request->input('content'),
        ];



        $dukungan = Dukungan::create($data);


        return redirect()->route('backend.dukungan.index')->with(['success' => 'Data Dukungan Berhasil Disimpan!']);
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit(Dukungan $dukungan)
    {

        return view('backend.dukungan.edit', [
            'dukungan'   => $dukungan,
            'title' => 'Dukungan Edit',
        ]);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(RequestDukunganUpdate $request, Dukungan $dukungan)
    {



        // Default data
        $data = [
            'title'           => $request->input('title'),
            'slug'            => Str::slug($request->input('title')),
            'content'         => $request->input('content'),
        ];

        $dukungan->update($data);


        return redirect()->route('backend.dukungan.index')->with(['success' => 'Data Berhasil Diperbaharui!']);
    }


}
