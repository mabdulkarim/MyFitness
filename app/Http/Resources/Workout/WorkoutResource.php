<?php

namespace App\Http\Resources\Workout;

use App\Http\Resources\Exercises\ExerciseResource;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkoutResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
                'description' => $this->description,
            ],
            'exercises' => ExerciseResource::collection($this->exercises),
        ];
    }
}
