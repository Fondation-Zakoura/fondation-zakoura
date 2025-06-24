<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNaturePartenaireRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $natureId = $this->route('natures_partenaire')->id;
        return [
            'nom' => 'required|string|max:255|unique:nature_partenaires,nom,' . $natureId,
        ];
    }
}