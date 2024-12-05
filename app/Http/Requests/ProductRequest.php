<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'price' => 'required',     
            'img.*' => 'image|max:1024'          
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute: Khong duoc de trong',
            'max' => ':attribute: Khong duoc qua :max ky tu',                   
            'image' => ':attribute: Hinh anh upload len phai la hinh anh',
            'imge.max' => ':attribute: Hinh anh upload len khong duoc vuot qua kich thuoc cho phep: max'
        ];
    }
}
