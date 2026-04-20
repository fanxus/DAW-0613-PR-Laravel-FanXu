<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCharacterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'sometimes',
                'required',
                'string',
                'min:3',
                'max:50',
                'regex:/^[A-Za-z0-9 _\-]+$/',
            ],

            'level' => [
                'sometimes',
                'required',
                'integer',
                'min:1',
                'max:100',
            ],
        ];
    }
    public function messages(): array
    {
        return [
            'name.regex' => 'The name can only contain letters, numbers, spaces, hyphens and underscores.',
            'level.min' => 'Level must be at least 1.',
            'level.max' => 'Level cannot exceed 100.',
        ];
    }
}
