<?php

namespace App\Http\Resources\Exercises;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExerciseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'exerciseSets' => ExerciseSetResource::collection($this->whenLoaded('exerciseSets')),
        ];
    }
}
