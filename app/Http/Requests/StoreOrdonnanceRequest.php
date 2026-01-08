<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrdonnanceRequest extends FormRequest
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
            'dateOrdonnance' => 'date_format:m/d/Y',
            'consultation_id ' => 'integer',
            'patient_id ' => 'integer',
            'docteur_id' => 'integer',
            'docteur_id ' => 'integer',

            // 'dateOrdonnance' => 'required|date_format:m/d/Y',
            // 'consultation_id ' => 'required|integer',
            // 'patient_id ' => 'required|integer',
            // 'docteur_id' => 'required|integer',
            // 'docteur_id '=>'required|integer',
        ];
    }
}
