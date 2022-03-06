<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplianceUpdateRequest extends FormRequest
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
            'SACNo' => ['required'],
            'Status' => [
                'nullable',
                'in:pending,checked in,test & repair,cleaning,quality control,listing,costing,ebay,finalizing,finalized',
            ],
            'ModelNumber' => ['nullable', 'max:255', 'string'],
            'Description' => ['nullable', 'max:255', 'string'],
            'Supplier' => ['nullable', 'max:255', 'string'],
            'purchase_date' => ['nullable', 'date'],
            'CostExVat' => ['nullable', 'numeric'],
            'VAT' => ['nullable', 'numeric'],
            'CostIncVAT' => ['nullable', 'numeric'],
            'PONumber' => ['nullable', 'max:255', 'string'],
            'OtherRef' => ['nullable', 'max:255', 'string'],
            'SerialNum' => ['nullable', 'max:255', 'string'],
            'Location' => ['nullable', 'max:255', 'string'],
        ];
    }
}
