<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherCreateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'lastname' => 'string|nullable|max:100',
            'email' => 'required|email|unique:teachers',
            'phone' => 'required|string|unique:teachers',
            'address' => 'required|string|max:100',
            'city' => 'required|string',
            'dni' => 'required|string|unique:teachers|max:20',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */

    public function messages()
    {
        return [
            'name.required' => 'El nombre es requerido',
            'name.string' => 'El nombre debe ser una cadena de texto',
            'lastname.string' => 'El apellido debe ser una cadena de texto',
            'lastname.max' => 'El apellido no debe tener más de 100 caracteres',
            'email.required' => 'El email es requerido',
            'email.email' => 'El email debe ser un email válido',
            'email.unique' => 'El email ya está en uso',
            'phone.required' => 'El teléfono es requerido',
            'phone.string' => 'El teléfono debe ser una cadena de texto',
            'phone.unique' => 'El teléfono ya está en uso',
            'address.required' => 'La dirección es requerida',
            'address.string' => 'La dirección debe ser una cadena de texto',
            'address.max' => 'La dirección no debe tener más de 100 caracteres',
            'city.required' => 'La ciudad es requerida',
            'city.string' => 'La ciudad debe ser una cadena de texto',
            'dni.required' => 'El DNI es requerido',
            'dni.string' => 'El DNI debe ser una cadena de texto',
            'dni.unique' => 'El DNI ya está en uso',
            'dni.max' => 'El DNI no debe tener más de 20 caracteres',
        ];
    }

    
}
