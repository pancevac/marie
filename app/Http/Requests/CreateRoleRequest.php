<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRoleRequest extends FormRequest
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
            'name' => 'required|unique:roles,name,'.$this->segment(3),
            'guard_name' => 'required|unique:roles,guard_name,'.$this->segment(3),
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
            'name.required' => 'Ime je obavezno',
            'name.unique' => 'Ime mora biti jedinstveno',
            'guard_name.required' => 'Zaštitničko ime je obavezno',
            'guard_name.unique' => 'Zaštitničko ime mora biti jedinstveno',
        ];
    }
}
