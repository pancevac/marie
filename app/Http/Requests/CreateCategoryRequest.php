<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
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
            'title.required' => 'Naziv kategorije je obavezan',
            'slug.required' => 'Slug je obavezan',
        ];
    }
}
