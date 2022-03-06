<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckInStoreRequest extends FormRequest
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
            'sac_num' => ['required'],
            'serial_num' => ['nullable', 'max:255', 'string'],
            'condition' => ['required', 'in:lightly used,heavily used,unused'],
            'appliance_in_img' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif|max:8192',
            'data_badge_img' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif|max:8192',
            'Location' => ['nullable', 'max:255', 'string'],
        ];
    }
}
