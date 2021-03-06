<?php

namespace App\Http\Requests\Apis;

use Illuminate\Foundation\Http\FormRequest;

class OwnerCarCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return TRUE;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'model'=>'required',
            'plate_number'=>'required',
            'maintenance_date'=>'required|regex:/^\d{1,2}\/\d{1,2}\/\d{4}$/',
            'mile_age'=>'required|numeric',
        ];
    }
}
