<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            'image'=>'image|mimes:jpeg,png,jpg,gif|max:2048',
            'title'=>'required|max:191',
            'description'=>'required|max:191',
            'content'=>'required|max:2000',       
        ];
    }
    public function messages()
    {
        return [
            'image'=> ':attribute: Hinh anh upload len phai la hinh anh',
            'mimes'=> ':attribute: Hinh anh upload len phai duoc dinh dang nhu sau:
                                    jpeg, png, jpg, gif',
            'image.max'=> ':attribute: Hinh anh upload len khong duoc vuot qua kich thuoc cho phep: max',
            'required'=>':attribute: Khong duoc de trong',
            'max'=>':attribute: Khong duoc qua :max ky tu'    
            
        ];
    }
}
