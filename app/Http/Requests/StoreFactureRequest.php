<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFactureRequest extends FormRequest
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
            // 'dateFacture' => 'required|date_format:m/d/Y',
            // 'tvaFacture' => 'required|float',
            // 'montantFacture' => 'required|float',
            // 'patient_id' => 'required|integer',
            // 'paiement_id' => 'required|integer'
        ];
    }
}
