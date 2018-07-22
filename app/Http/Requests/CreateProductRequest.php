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
            'brand_id' => 'required',
            'gender' => 'required',
            'category_ids' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif',
            'price' => 'required|numeric|min:1',
            'outlet_price' => 'required|numeric|min:1',
            'code' => 'required',
            'published_at' => 'required|date',
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
            'brand_id.required' => 'Brend je obavezan',
            'gender.required' => 'Pol je obavezan',
            'image.image' => 'Slika nije u ispravnom formatu',
            'image.mimes' => 'Slika nije u jpg, jpeg, png ili gif formatu',
            'price.required' => 'Cena je obavezna',
            'price.numeric' => 'Cena mora biti broj',
            'price.min' => 'Cena mora biti veća od nule',
            'outlet_price.required' => 'Outlet cena je obavezna',
            'outlet_price.numeric' => 'Outlet cena mora biti broj',
            'outlet_price.min' => 'Outlet cena mora biti veća od nule',
            'category_ids.required' => 'Kategorija je obavezna',
            'code.required' => 'Šifra proizvoda je obavezna',
            'published_at.required' => 'Datum publikovanja je obavezan',
            'published_at.date' => 'Datum publikovanja nije u ispravnom formatu',
        ];
    }
}
