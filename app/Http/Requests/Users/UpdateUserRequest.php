<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $this->merge([$this->nameCol => $this->value]);
        $rules  = [
            'name' => [
                'required',
            ],
            'email' => [
                'required',
                'email'
            ],
            'phone' => [
                'numeric',
                'required',
                'digits:10'
            ],
            'gender' => [
                'required'
            ],
        ];   
        return [
            $this->nameCol => $rules[$this->nameCol],  
        ];
    }

    public function messages()
    {
        return [
            // 'name.required' => 'Tên không được để trống',
        ];
    }

}