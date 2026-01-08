<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSecretaireRequest extends FormRequest
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

            'cinSecretaire' =>'required|string|max:10',
            'nomSecretaire' =>'required|string|max:255',
            'prenomSecretaire' =>'required|string|max:255',
           // 'dateNaissanceSecretaire' => 'date_format:dd/mm/YYYY',
            'telephoneSecretaire' =>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
            'adresseSecretaire' =>'required|string|max:255',
           // 'sexeSecretaire' => 'required|string|max:10',
            'villeSecretaire' => 'required|string|max:255',
            'emailSecretaire' => 'email',
            'nationaliteSecretaire' => 'required|string|max:10',
            'descriptionSecretaire' => 'string|max:255',
        ];
    }
}
