<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubjectCreateRequest extends FormRequest
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
            'description' => 'required|string',
            'credits' => 'required|integer|min:1|max:10',
            'knowledge_area' => 'required|string',
            'code' => 'required|string|unique:subjects,code|max:20',
            'type' => 'required|in:obligatory,elective',
            'teacher_id' => 'required|integer|exists:teachers,id'
        ];
    }
}
