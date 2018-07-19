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
            'image' => 'nullable|image|dimensions:width=800,height=450',
            'image_box' => 'nullable|image|dimensions:width=600,height=600',
            'blog_ids' => 'required',
            'publish_at' => 'required|date',
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
            'image.image' => 'Slika slajdera nije u ispravnom formatu',
            'image.dimensions' => 'Slika slajdera mora biti dimenzija 800x450 px',
            'image_box.image' => 'Slika članka nije u ispravnom formatu',
            'image_box.dimensions' => 'Slika članka mora biti dimenzija 600x600 px',
            'blog_ids.required' => 'Jedna kategorija je obavezna',
            'blog_ids.array' => 'Jedna kategorija je obavezna',
            'publish_at.required' => 'Datum publikovanja je obavezan',
            'publish_at.date' => 'Datum publikovanja nije u ispravnom formatu',
        ];
    }
}
