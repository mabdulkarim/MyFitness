<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
                'string',
                'max:255',
            ],
            'email' => [
                'string',
                'email',
                'unique:users,email,'.auth()->id(),
                'max:255',
            ],
            'password' => [
                'string',
                'min:8',
                'confirmed',
            ],
            'age' => [
                'numeric',
                'between:16,120',
            ],
            'gender' => [
                'string',
                'in:male,female',
            ],
            'height' => [
                'numeric',
                'between:120,300',
            ],
        ];
    }
}
