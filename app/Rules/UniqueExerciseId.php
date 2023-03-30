<?php

namespace App\Rules;

use App\Models\Exercise;
use App\Models\Workout;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\InvokableRule;

class UniqueExerciseId implements DataAwareRule, InvokableRule
{
    protected array $data = [];

    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        $workout = Workout::where('id', $this->data['workout_id'])
            ->first()
            ->whereHas('exercises', function ($query) use ($value) {
                $query->where('exercise_id', $value);
            })
            ->get();

        if ($workout->count() > 0) {
            $fail('One of the selected exercises already exists inside this workout.');
        };
    }

    public function setData($data): UniqueExerciseId|static
    {
        $this->data = $data;

        return $this;
    }
}
