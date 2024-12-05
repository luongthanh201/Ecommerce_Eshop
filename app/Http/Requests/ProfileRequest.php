<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'name'=>'required|max:191',
            'email'=>'required|email|unique:users',
            'password'=>'required',
            'phone'=>'required|max:12',           
            'avatar'=>'image|mimes:jpeg,png,jpg,gif|max:1024'
        ];
    }
    public function messages()
    {
        return [
            'required'=>':attribute: Khong duoc de trong',
            'max'=>':attribute: Khong duoc qua :max ky tu',
            'email.email'=> ':attribute: email sai dinh dang',
            'email.unique'=> ':attribute: email da ton tai',
            'avatar'=> ':attribute: Hinh anh upload len phai la hinh anh',
            'mimes'=> ':attribute: Hinh anh upload len phai duoc dinh dang nhu sau:
                                    jpeg, png, jpg, gif',
            'avatar.max'=> ':attribute: Hinh anh upload len khong duoc vuot qua kich thuoc cho phep: max'
        ];
    }
}

