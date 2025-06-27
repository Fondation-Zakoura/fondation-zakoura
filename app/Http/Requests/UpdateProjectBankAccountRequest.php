<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectBankAccountRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
             'rib' => 'required|string',
            'bank' => 'required|string|max:255',
            'agency' => 'required|string|max:255',
        ];
    }
}
