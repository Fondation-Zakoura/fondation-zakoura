<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBankAccountRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'partner_id' => 'nullable|integer',
            'account_id' => 'nullable|integer',
            'account_label' => 'required|string|max:255',
            'bank' => 'required|string|max:255',
            'agency' => 'nullable|string|max:255',
            'country' => 'required|string|max:255',
            'currency' => 'required|string|max:10',
            'account_holder' => 'required|string|max:255',
            'rib_iban' => 'required|string|max:34',
            'bic_swift' => 'nullable|string|max:20',
            'opening_date' => 'nullable|date',
            'status' => 'required|string',
            'supporting_document' => 'nullable|string',
            'comments' => 'nullable|string',
            'created_by' => 'required|integer',
        ];
    }
}
