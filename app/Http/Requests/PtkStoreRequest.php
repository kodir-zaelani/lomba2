<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PtkStoreRequest extends FormRequest
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
            'image' => 'image|mimes:jpeg,jpg,png,webp|max:2024',
            'name'      => 'required|min:2',
            'jabatan'   => 'required',
            'email'     => 'required|email|unique:ptk,email',
        ];
    }
}
