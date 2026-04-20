<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
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
                'string',
                'min:3',
                'max:50',
                'regex:/^[A-Za-z0-9 _\-]+$/',
            ],

            'type' => [
                'sometimes',
                'in:weapon,armor,consumable',
            ],

            'slot' => [
                'nullable',
                'in:head,body,weapon',
            ],

            'power' => [
                'sometimes',
                'integer',
                'min:0',
            ],
        ];
    }
    public function messages(): array
    {
        return [
            'name.min' => 'Item name must have at least 3 characters.',
            'name.max' => 'Item name cannot exceed 50 characters.',
            'name.regex' => 'Item name can only contain letters, numbers, spaces, hyphens and underscores.',

            'type.in' => 'Item type must be weapon, armor or consumable.',

            'slot.in' => 'Slot must be head, body or weapon.',

            'power.integer' => 'Power must be a number.',
            'power.min' => 'Power cannot be negative.',
        ];
    }
}
