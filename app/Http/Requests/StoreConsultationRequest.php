<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreConsultationRequest extends FormRequest
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
            // 'dateConsultation' => 'required|date_format:m/d/Y',
            // 'poidsClient' => 'required|float',
            // 'tailleClient' => 'required|float',
            // 'docteur_id' => 'required|integer',
            // 'ordonnance_id'=>'required|integer',
            // 'facture_id'=>'required|integer',
        ];
    }
}
