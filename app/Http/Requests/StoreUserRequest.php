<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'string',
                'email',
                'unique:users,email',
                'max:255',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
            'age' => [
                'required',
                'numeric',
                'between:16,120',
            ],
            'gender' => [
                'required',
                'string',
                'in:male,female',
            ],
            'height' => [
                'required',
                'numeric',
                'between:120,300',
            ],
            'weight' => [
                'nullable',
                'numeric',
                'between:20, 500',
            ],
            'body_fat_percentage' => [
                'nullable',
                'numeric',
            ],
        ];
    }
}
