<?php

namespace App\Http\Controllers\Backend;

use App\Models\Sekolah;
use App\Models\Dukungan;
use App\Models\Spbinaan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Jenjangpendidikan;
use App\Http\Controllers\Controller;
use App\Http\Requests\RequestBinaanStore;
use App\Http\Requests\RequestBinaanUpdate;

class BinaanController extends Controller
{
    public function index()
    {
        return view('backend.binaan.index',[
            'title' => 'Pendampingan',
        ]);
    }

    public function create()
    {
        return view('backend.binaan.create',[
            'sekolah' => Sekolah::orderBy('nama', 'asc')->get(),
            'dukungan' => Dukungan::orderBy('created_at', 'asc')->get(),
            'datajenjangpendidikan' => Jenjangpendidikan::orderBy('jenjang_pendidikan_id', 'asc')->get(),
            'title' => 'Pendampingan',
        ]);
    }

    public function store(RequestBinaanStore $request)
    {
        // Default data
        $data = [
            'sekolah_id'           => $request->input('sekolah_id'),
            'jenjangpendidikan_id' => $request->input('jenjangpendidikan_id'),
            'dukungan_id'          => $request->input('dukungan_id'),
            'strategi'             => $request->input('strategi'),
            'lingkup_pembahasan'   => $request->input('lingkup_pembahasan'),
            'program_kerja'        => $request->input('program_kerja'),
            'kelebihan'            => $request->input('kelebihan'),
            'kondisi_real'         => $request->input('kondisi_real'),
            'umpan_balik'          => $request->input('umpan_balik'),
            'perubahan'            => $request->input('perubahan'),
            'rencana_perbaikan'    => $request->input('rencana_perbaikan'),
            'status'               => $request->input('status'),
        ];



        $spbinaan = Spbinaan::create($data);


        return redirect()->route('backend.binaan.index')->with(['success' => 'Data Binaan Berhasil Disimpan!']);
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit(Spbinaan $spbinaan)
    {

        return view('backend.binaan.edit', [
            'spbinaan'   => $spbinaan,
            'sekolah' => Sekolah::orderBy('nama', 'asc')->get(),
            'dukungan' => Dukungan::orderBy('created_at', 'asc')->get(),
            'datajenjangpendidikan' => Jenjangpendidikan::orderBy('jenjang_pendidikan_id', 'asc')->get(),
            'title' => 'Pendampingan',
        ]);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(RequestBinaanUpdate $request, Spbinaan $spbinaan)
    {



        // Default data
        $data = [
            'sekolah_id'           => $request->input('sekolah_id'),
            'jenjangpendidikan_id' => $request->input('jenjangpendidikan_id'),
            'dukungan_id'          => $request->input('dukungan_id'),
            'strategi'             => $request->input('strategi'),
            'lingkup_pembahasan'   => $request->input('lingkup_pembahasan'),
            'program_kerja'        => $request->input('program_kerja'),
            'kelebihan'            => $request->input('kelebihan'),
            'kondisi_real'         => $request->input('kondisi_real'),
            'umpan_balik'          => $request->input('umpan_balik'),
            'perubahan'            => $request->input('perubahan'),
            'rencana_perbaikan'    => $request->input('rencana_perbaikan'),
            'status'               => $request->input('status'),
        ];

        $spbinaan->update($data);


        return redirect()->route('backend.binaan.index')->with(['success' => 'Data Berhasil Diperbaharui!']);
    }
     /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show(Spbinaan $spbinaan)
    {

        return view('backend.binaan.show', [
            'spbinaan'   => $spbinaan,
            'sekolah' => Sekolah::orderBy('nama', 'asc')->get(),
            'dukungan' => Dukungan::orderBy('created_at', 'asc')->get(),
            'datajenjangpendidikan' => Jenjangpendidikan::orderBy('jenjang_pendidikan_id', 'asc')->get(),
            'title' => 'Pendmapingan',
        ]);
    }
}