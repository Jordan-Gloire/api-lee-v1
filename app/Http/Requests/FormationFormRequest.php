<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormationFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
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
        return [
            //
            'nom' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'prix' => ['required', 'numeric'],
            'date_debut' => ['required', 'date'],
            'date_fin' => ['required', 'date'],
            'nombre_heures' => ['required', 'integer'],
            'nombre__de_modules' => ['nullable', 'integer'],
            'nombre_de_cours' => ['nullable', 'integer'],
        ];
    }
}
