<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestBinaanUpdate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'sekolah_id'         => 'required',
            'dukungan_id'        => 'required',
            'strategi'           => 'required',
            'lingkup_pembahasan' => 'required',
            'program_kerja'      => 'required',
            'kelebihan'          => 'required',
            'kondisi_real'       => 'required',
            'umpan_balik'        => 'required',
            'perubahan'          => 'required',
            'rencana_perbaikan'  => 'required',
        ];
    }
}
