<?php

namespace App\Http\Requests\Apis;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class socialRequest extends FormRequest
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
            'social_id'=>'required',
            'social_type'=>'required',
            'full_name'=>'required',
            'email'=>'required|unique:users,email', 
            'phone_number'=>'required|numeric',
          

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
