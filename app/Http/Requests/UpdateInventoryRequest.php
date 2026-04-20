<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateInventoryRequest extends FormRequest
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
           'character_id' => [
               'sometimes',
               'integer',
               'exists:characters,id',
           ],

           'item_id' => [
               'sometimes',
               'integer',
               'exists:items,id',
           ],

           'quantity' => [
               'sometimes',
               'integer',
               'min:1',
           ],

           'equipped' => [
               'sometimes',
               'boolean',
           ],
    ];
    }
    public function messages(): array
    {
        return [
            'character_id.exists' => 'Character does not exist.',

            'item_id.exists' => 'Item does not exist.',

            'quantity.integer' => 'Quantity must be a number.',
            'quantity.min' => 'Quantity must be at least 1.',

            'equipped.boolean' => 'Equipped must be true or false.',
        ];
    }
}
