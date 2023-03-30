<?php

namespace App\Http\Requests\Workout;

use App\Rules\UniqueExerciseId;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateWorkoutRequest extends FormRequest
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
            'workout_id' => [
                'required',
                'numeric',
            ],
            'name' => [
                'string',
                'max:64',
            ],
            'description' => [
                'string',
                'max:255'
            ],
            'exercises' => [
                'array',
                new UniqueExerciseId,
            ],
            'exercises.*' => [
                'numeric',
            ],
        ];
    }
}
