<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $projectId = $this->route('projet') ? $this->route('projet')->id : null;

        return [
            'project_name' => 'required|string|max:255',
            'project_nature' => ['required','string' ],
            'project_type_id' => ['required', 'exists:project_types,id'],
            'project_status_id' => ['required', 'exists:project_statuses,id'],
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'actual_start_date' => 'nullable|date|after_or_equal:start_date',
            'responsible_id' => 'required|exists:users,id',
            'total_budget' => 'required|numeric|min:0',
            'zakoura_contribution' => 'nullable|numeric|min:0',
            'project_bank_account_id' => 'required|exists:project_bank_accounts,id',
            'notes' => 'nullable|string',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'project_code.unique' => 'Le code de projet existe déjà. Veuillez en choisir un autre.',
            'responsible_id.required' => 'Le responsable du projet est requis.',
            'responsible_id.exists' => 'Le responsable sélectionné est invalide.',
            'partners.*.id.exists' => 'Un ou plusieurs partenaires sélectionnés sont invalides.',
            'start_date.after_or_equal' => 'La date de clôture doit être postérieure ou égale à la date de lancement.',
            'actual_start_date.after_or_equal' => 'La date de début réelle doit être postérieure ou égale à la date de lancement.',
        ];
    }
}
