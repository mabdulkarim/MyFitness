<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'user' => [
                'id' => $this->id,
                'name' => $this->name,
                'age' => $this->age,
                'gender' => $this->gender,
                'height' => $this->height,
                'email' => $this->email,
            ],
            'userMeasurements' => UserMeasurementResource::collection($this->whenLoaded('userMeasurements')),
        ];
    }
}
