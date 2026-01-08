<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            // 'cinPatient' => 'string|max:10',
            // 'codePatient' => 'string|max:255',
            'nomPatient' => 'string|max:255',
            'prenomPatient' => 'string|max:255',
            // 'sexePatient' => 'string|max:10',
            // 'adressePatient' => 'string|max:50',
            // 'villePatient' => 'string|max:255',
            // 'telephonePatient' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
            // 'dateNaissancePatient' => 'date',
            // 'nationalitePatient' => 'string|max:9',
            // 'descriptionPatient' => 'string',
            // 'emailPatient' => 'email',
            // 'statutPatient' => 'string',
            // 'isActive' => 'boolean'
            // 'assurance_id ' => 'required',
        ];
    }
}
