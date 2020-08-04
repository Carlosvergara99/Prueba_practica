<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'publish_date' => 'required|date',
            'title' => 'required|min:3|max:255',
            'author_id' => 'required'
        ];
    }

    public function messages()
    {
    return [
        'publish_date.required' => 'El campo fecha de publicacion es obligatorio.',
        'publish_date.date' => 'El campo fecha de publicacion debe ser una fecha valida.',
        'title.required' => 'El campo titulo es obligatorio.',

        'title.min' => 'El titulo  debe ser mínimo 3 caracteres ',
        'title.max' => 'El titulo no debe tener  255 caracteres',
        'author_id.required' => 'El autor es obligatorio.'
         ]; 
    }
}
