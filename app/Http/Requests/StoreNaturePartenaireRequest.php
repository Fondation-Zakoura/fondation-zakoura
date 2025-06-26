<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNaturePartenaireRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'nom' => 'required|string|max:255|unique:nature_partenaires,nom',
        ];
    }
}