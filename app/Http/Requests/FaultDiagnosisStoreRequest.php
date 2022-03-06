<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FaultDiagnosisStoreRequest extends FormRequest
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
            'time_started' => ['required'],
            'time_finished' => ['required'],
            'fault_found' => ['nullable', 'max:255', 'string'],
            'parts_required' => ['nullable', 'max:255', 'string'],
            'repaired' => ['required', 'boolean'],
            'test_again' => ['required', 'boolean'],
        ];
    }
}
