<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePatientRequest extends FormRequest
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
            // 'cinPatient' => 'required|string|max:10',
            // 'codePatient' => 'required|string|max:255',
            // 'nomPatient' => 'required|string|max:255',
            // 'prenomPatient' => 'required|string|max:255',
            // 'sexePatient' => 'required|string|max:10',
            // 'adressePatient' => 'required|string|max:50',
            // 'villePatient' => 'required|string|max:255',
            // 'telephonePatient' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
            // 'dateNaissancePatient' => 'required|date',
            // 'nationalitePatient' => 'required|string|max:9',
            // 'descriptionPatient' => 'string',
            // 'emailPatient'=>'email',
            // 'statutPatient'=>'string'
            //'assurance_id ' => 'required',
        ];
    }
}
