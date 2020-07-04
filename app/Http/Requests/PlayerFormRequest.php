<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlayerFormRequest extends FormRequest
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
            'name' => 'required|string',
            'position' => 'required|max:20',
            'goals' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El input nombres es requerido',
            'name.string' => 'El input nombres  tiene que ser un texto',
            'position.required' => 'El input posición es requerido',
            'position.max' => 'El input posición tiene que ser menor a 20 caracteres',
            'goals.required' => 'El input goles es requerido',
            'goals.numeric' => 'El input goles tiene que ser un número',
        ];
    }
}
