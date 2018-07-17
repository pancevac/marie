<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBannerRequest extends FormRequest
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
            'title' => 'required',
            'link' => 'required',
            'image' => 'required|image|mimes:jpg,gif,jpeg,png',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Naziv je obavezan',
            'link.required' => 'Link je obavezan',
            'image.required' => 'Slika je obavezna',
            'image.image' => 'Slika je u ispravnom formatu',
            'image.mimes' => 'Slika mora biti u jpg, jpeg, gif ili png formatu',
        ];
    }
}
