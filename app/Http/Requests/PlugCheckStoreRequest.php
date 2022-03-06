<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlugCheckStoreRequest extends FormRequest
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
            'pass_test' => ['required', 'boolean'],
            'repair_type' => ['nullable', 'in:not required,earth,flash,ir'],
            'insulation' => ['nullable','max:255', 'string'],
            'earth' => ['nullable', 'max:255', 'string'],
            'gas' => ['nullable', 'boolean'],
        ];
    }
}
