<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInventoryRequest extends FormRequest
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
            'required',
            'integer',
            'exists:characters,id',
        ],

        'item_id' => [
            'required',
            'integer',
            'exists:items,id',
        ],

        'quantity' => [
            'required',
            'integer',
            'min:1',
        ],

        'equipped' => [
            'nullable',
            'boolean',
        ],
    ];
    }
}
