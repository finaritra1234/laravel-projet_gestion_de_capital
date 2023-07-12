<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreChambreRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'nbrPers' =>'required',
            'etage' =>'required|string',
            'telCh'  =>'required|string',
            'status'  =>'required|string',
            'imgCh'  =>'nullable|string',
            'categorie_id'  =>'required',
            'hotel_id'  =>'required'
        ];
    }
}
