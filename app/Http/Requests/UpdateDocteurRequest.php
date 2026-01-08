<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDocteurRequest extends FormRequest
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
            'nomDocteur' => 'required|string',
            'prenomDocteur' => 'required|string',
            'adresseDocteur' => 'required|string|max:255',
            'telephoneDocteur' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
            'specialiteDocteur'=>'required|string|max:255',
            'codeDocteur'=> 'string|max:55',
            "sexeDocteur"=> 'required|string|max:255',
            'villeDocteur'=> 'required|string|max:255',
            'emailDocteur'=> 'required|string|max:255',
            'dateNaissanceDocteur'=>'date_format:m/d/Y',
            'nationaliteDocteur'=> 'required|string|max:255',
            'descriptionDocteur'=> 'string|max:255',
            'profile_photo_path'=> 'string|max:255',
        ];
    }
}
