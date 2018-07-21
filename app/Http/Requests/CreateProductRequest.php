<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            'slug' => 'required',
            'link' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif',
        ];
    }

    /**
     * Get the validation rules messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'Naziv je obavezan',
            'slug.required' => 'Slug je obavezan',
            'link.required' => 'Link je obavezan',
            'image.image' => 'Slika nije u ispravnom formatu',
            'image.mimes' => 'Slika nije u jpg, jpeg, png ili gif formatu',
        ];
    }
}
