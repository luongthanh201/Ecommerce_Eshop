<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddRequest extends FormRequest
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
    public function rules()
    {
        return [
            'tenCT'=>'required|max:191',
            'tuoi'=>'required',
            'quoctich'=>'required',
            'vitri'=>'required',
            'luong'=>'required|max:10'
        ];
    }
    public function messages()
    {
        return [
            'required'=>':attribute: Khong duoc de trong',
            'max'=>':attribute: Khong duoc qua :max ky tu'
        ];
    }
}
