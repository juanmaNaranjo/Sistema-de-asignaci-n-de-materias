<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class sClassCreateRequest extends FormRequest
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
            'day' => 'required|string',
            'hour' => 'required|string',
            'teacher_id' => 'required|integer|exists:teachers,id',
            'subject_id' => 'required|integer|exists:subjects,id',
        ];
    }
}
