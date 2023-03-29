<?php

namespace App\Http\Resources\Exercises;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExerciseSetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'exercise_id' => $this->exercise_id,
            'weight' => $this->weight,
            'sets' => $this->sets,
            'repetitions' => $this->repetitions,
        ];
    }
}
