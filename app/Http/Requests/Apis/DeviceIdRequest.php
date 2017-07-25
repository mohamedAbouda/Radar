<?php

namespace App\Http\Requests\Apis;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;


class DeviceIdRequest extends FormRequest
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
            'registration_id'=>'required',
        ];
    }

    public function formatErrors(Validator $validator)
    {
        $error=array();

        foreach($validator->getMessageBag()->toArray() as $m => $key){

            array_push($error,$key[0]);
        }

        return (['error'=>$error]);
    }
}
