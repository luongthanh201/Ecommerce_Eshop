<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email'=>'required|email',
            'password'=>'required|max:10',
        ];
    }
    public function messages(){
       return[
        'required'=>':attribute: Khong duoc de trong',
        'max'=>':attribute: Khong duoc qua :max ky tu',
        'email.email' => ':attribute: email sai dinh dang'
       ];
    }
}
