<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QualityControlStoreRequest extends FormRequest
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
            'condition' => ['required', 'in:grade a,grade. b,grade c'],
            'parts_burners' => ['required', 'in:not required,yes,no'],
            'parts_pan_supports' => ['required', 'in:not required,yes,no'],
            'parts_grill_tray' => ['required', 'in:not required,yes,no'],
            'parts_oven_shelves' => ['required', 'in:not required,yes,no'],
            'parts_oven_rails' => ['required', 'in:not required,yes,no'],
            'parts_door_glass' => ['required', 'in:not required,yes,no'],
            'parts_fridge_shelves' => ['required', 'in:not required,yes,no'],
            'cosmetic_marks' => ['nullable', 'max:255', 'string'],
            'cosmetic_mark_1_img' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif|max:8192',
            'cosmetic_mark_2_img' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif|max:8192',
            'cosmetic_mark_3_img' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif|max:8192',
            'cosmetic_mark_4_img' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif|max:8192',
            'cosmetic_mark_5_img' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif|max:8192',
            'cosmetic_mark_6_img' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif|max:8192',
            'cosmetic_mark_7_img' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif|max:8192',
            'cosmetic_mark_8_img' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif|max:8192',
            'cosmetic_mark_9_img' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif|max:8192',
            'cosmetic_mark_10_img' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif|max:8192',
            'cosmetic_mark_11_img' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif|max:8192',
            'cosmetic_mark_12_img' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif|max:8192',
            'cosmetic_mark_13_img' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif|max:8192',
            'cosmetic_mark_14_img' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif|max:8192'
        ];
    }
}
