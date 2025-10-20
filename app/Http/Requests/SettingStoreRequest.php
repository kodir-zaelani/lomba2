<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

            return [
            'logo'           => 'image|mimes:jpeg,jpg,png|max:400',
            'favicon'           => 'image|mimes:png|max:100',
            'webname'           => 'required',
            // 'tagline'           => 'required',
            // 'siteurl'           => 'required',
            // 'homeurl'           => 'required',
            // 'description'    => 'required|max:350',
        ];
    }
}
