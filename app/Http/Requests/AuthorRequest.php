<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
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
            'name' => 'required|min:3|max:255'
        ];
    }
    public function messages()
    {
    return [
        'name.required' => 'El nombre es obligatorio.',
        'name.min' => 'El nombre debe ser mínimo 3 caracteres ',
        'name.max' => 'El nombre no debe tener  255 caracteres'
         ]; 
    }
}
