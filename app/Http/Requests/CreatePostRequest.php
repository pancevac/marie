<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
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
            'short' => 'required',
            'blog_ids' => 'required',
        ];
    }

    /**
     * method used to translate error message
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'Naziv članka je obavezan',
            'slug.required' => 'Slug je obavezan',
            'short.required' => 'Kratak opis je obavezan',
            'blog_ids.required' => 'Jedna kategorija je obavezna',
            'blog_ids.array' => 'Jedna kategorija je obavezna',
        ];
    }
}
