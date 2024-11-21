<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *authorize-인증체크용이다
     * @return bool
     */
     // public function authorize()
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *rules - validation생성할 때 생긴 룰을 적으면 된다
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'account' => ['required','between:5,20', 'regex:/^[0-9a-zA-Z]+$/']
            ,'password' => ['required','between:5,20', 'regex:/^[0-9a-zA-Z!@]+$/']
        ];
        if($this->routeIs('post.login')){
            $rules['account'][]='exists:users,account';
        }
        return $rules;
    }
    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            // Validation에서 에러가 발생되어 걸린것
            'succes' => false,
            'message' =>'유효성체크 오류입니다',
            'data' => $validator ->errors()
        ],422);
        throw new HttpResponseException($response);
    }
}
