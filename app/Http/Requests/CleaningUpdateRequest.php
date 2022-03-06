<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CleaningUpdateRequest extends FormRequest
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
            'time_started' => ['required', 'date'],
            'time_finished' => ['required', 'date'],
            'inside_before_img' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif|max:8192',
            'outside_before_img' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif|max:8192',
            'inside_after_img' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif|max:8192',
            'outside_after_img' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif|max:8192'
        ];
    }
}
