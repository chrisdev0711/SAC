<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActionUpdateRequest extends FormRequest
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
            'actionable_id' => ['required', 'max:255'],
            'actionable_type' => ['required', 'max:255', 'string'],
            'appliance_id' => ['required', 'exists:appliances,id'],
            'actioned_by' => ['required', 'exists:users,id'],
        ];
    }
}
